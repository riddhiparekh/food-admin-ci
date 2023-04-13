<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderCtrl extends CI_Controller
{

	public function __construct()
    {
        parent::__construct();
        Auth::check();
    }

    public function index()
    {
    	$data['orders'] = Order::with('items', 'items.product', 'address')->pendingOrders()->get();
        $data['assigned_order_count'] = Order::AssignedOrders()->count();
        $data['pickup_order_count'] = Order::ReadyToPickOrders()->count();
        $data['shipped_order_count'] = Order::ShippedOrders()->count();
        $data['users'] = User::with('profile')->deliveryBoy()->get();
        $layoutData['page'] = 'orders/index';
        $layoutData['pageTitle'] = 'New Orders - ' . WEBSITE_TITLE;
        $layoutData['pageData'] = $data;
        $this->load->view('layout', $layoutData);
    }

    public function store()
    {
        $step = $this->input->post('order_status', true);
        $inputs = $this->input->post();
        $this->load->library('OrderProcedure');
        switch ($step) {
            case 'assign':
                $response = $this->orderprocedure->assign($inputs);
                break;
            case 'reject':
                $response = $this->orderprocedure->reject($inputs);
                break;
            case 'pickup':
                $response = $this->orderprocedure->pickup($inputs);
                break;
            case 'reassign':
                $response = $this->orderprocedure->assign($inputs);
                break;
            case 'shipped':
                $response = $this->orderprocedure->ship($inputs);
                break;
            case 'completed':
                $response = $this->orderprocedure->complete($inputs);
                break;
            default:
                $response = $this->orderprocedure->assign($inputs);
                break;
        }
        if($response['status']) {
            $this->session->set_flashdata('success_msg', $response['msg']);
        } else {
            $this->session->set_flashdata('error_msg', $response['msg']);
        }
        $this->load->library('user_agent');
        redirect($this->agent->referrer());
    }

    public function assigned()
    {
        $data['orders'] = Order::with('items', 'items.product', 'address')->AssignedOrders()->get();
        $data['pending_order_count'] = Order::PendingOrders()->count();
        $data['pickup_order_count'] = Order::ReadyToPickOrders()->count();
        $data['shipped_order_count'] = Order::ShippedOrders()->count();
        $data['users'] = User::with('profile')->deliveryBoy()->get();
        $layoutData['page'] = 'orders/assigned';
        $layoutData['pageTitle'] = 'New assigned Orders - ' . WEBSITE_TITLE;
        $layoutData['pageData'] = $data;
        $this->load->view('layout', $layoutData);
    }

    public function pickup()
    {
        $data['orders'] = Order::with('items', 'items.product', 'address')->ReadyToPickOrders()->get();
        $data['pending_order_count'] = Order::PendingOrders()->count();
        $data['assigned_order_count'] = Order::AssignedOrders()->count();
        $data['shipped_order_count'] = Order::ShippedOrders()->count();
        $layoutData['page'] = 'orders/pickup';
        $layoutData['pageTitle'] = 'New assigned Orders - ' . WEBSITE_TITLE;
        $layoutData['pageData'] = $data;
        $this->load->view('layout', $layoutData);
    }

    public function shipped()
    {
        $data['orders'] = Order::with('items', 'items.product', 'address')->ShippedOrders()->get();
        $data['pending_order_count'] = Order::PendingOrders()->count();
        $data['assigned_order_count'] = Order::AssignedOrders()->count();
        $data['pickup_order_count'] = Order::ReadyToPickOrders()->count();
        $layoutData['page'] = 'orders/ship';
        $layoutData['pageTitle'] = 'New assigned Orders - ' . WEBSITE_TITLE;
        $layoutData['pageData'] = $data;
        $this->load->view('layout', $layoutData);
    }


    public function cancelled()
    {
        $data['orders'] = Order::with('items', 'items.product', 'address')->CancelledOrders()->latest()->get();
        $data['new_order_count'] = Order::NewOrders()->count();
        $layoutData['page'] = 'orders/cancelled';
        $layoutData['pageTitle'] = 'Cancelled Orders - ' . WEBSITE_TITLE;
        $layoutData['pageData'] = $data;
        $this->load->view('layout', $layoutData);
    }

    public function completed()
    {
        $data['orders'] = Order::with('items', 'items.product', 'address')->CompletedOrders()->latest()->get();
        $data['new_order_count'] = Order::NewOrders()->count();
        $layoutData['page'] = 'orders/completed';
        $layoutData['pageTitle'] = 'Completed Orders - ' . WEBSITE_TITLE;
        $layoutData['pageData'] = $data;
        $this->load->view('layout', $layoutData);
    }
}