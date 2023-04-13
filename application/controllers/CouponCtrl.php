<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CouponCtrl extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		Auth::check();
	}
	public function index()
	{
		$layoutData['page'] = 'coupon/index';
		$layoutData['pageTitle'] = 'Manage Coupons - ' . WEBSITE_TITLE;
		$layoutData['pageData'] = array();
		$this->load->view('layout', $layoutData);
	}
	public function create()
	{
		$this->load->view('coupon/add');
	}
	public function edit($id)
	{
		$data['record'] = Coupon::find($id)->toArray();
		$this->load->view('coupon/update', $data);
	}
	public function store()
	{
		$data = $this->input->post(); 
		if (in_array('', $data)) {
			exit(json_encode([
				"status" => false,
				"msg" => "Coupon data can not be empty!",
			]));
		}
		$result = Coupon::create($data);
		if (!$result) {
			exit(json_encode([
				'status' => false,
				'msg' => 'Something went wrong!',
			]));
		}
		echo json_encode([
			'status' => true,
			'msg' => 'Coupon data inserted successfully!',
		]);
	}
	public function update($id)
	{
		$data = $this->input->post();
		if (in_array('', $data)) {
			exit(json_encode([
				"status" => false,
				"msg" => "Coupon data can not be empty!",
			]));
		}
		$coupon = Coupon::find($id);
		$result = $coupon->update($data);
		if (!$result) {
			exit(json_encode([
				'status' => false,
				'msg' => 'Something went wrong!',
			]));
		}
		echo json_encode([
			'status' => true,
			'msg' => 'Coupon data updated successfully!',
		]);
	}
	public function get()
	{
		$draw = intval($this->input->get('draw', true));
		$this->load->model('CommonModel');
		$this->load->helper('datatable');
		$data = datatable($this->input->get());
		$data['table'] = ' coupons';
		$data['select'] = 'id, title, code, amount, amount_type, CONCAT(valid_from," - ", valid_till) as validity, CONCAT(min_orders, " - ", max_orders) as order_range, CONCAT(min_order_value, " - ", 
		max_order_value) as order_amount_range';
		$data['condition']['deleted_at'] = $condition['deleted_at'] = null;
		$recordTotal = $this->CommonModel->getDataCount($condition, 'coupons');
		$records = $this->CommonModel->datatableQueryBuilder($data, 'array');
		$filteredRecords = $this->CommonModel->datatableQueryBuilder($data, 'count');
		$records = array_map(function ($record) {
			$id = $record['id'];
			$record['amount'] .= $record['amount_type'] == 'flat' ? '<i class="fa fa-inr"></i>' : ' %';
			$record['action'] = "
			<a href='javascript:void(0)' onclick='openModal(`Update Coupon`,`" . base_url("/coupon/$id/update") . "`,`md`)' title='Edit'><i class='text-info icon-pencil7'></i></a>
			<a href='javascript:void(0)' onclick='deleteCoupon(`$id`)' title='Delete'><i class='text-danger icon-eraser2'></i></a>";
			return $record;
		}, $records);
		$result = [
			'draw' => $draw,
			'recordsTotal' => $recordTotal,
			'recordsFiltered' => $filteredRecords,
			'data' => $records,
		];
		echo json_encode($result);
		exit();
	}
	public function remove($id)
	{
		$coupon = Coupon::find($id);
		$result = $coupon->delete();
		if (!$result) {
			exit(json_encode([
				'status' => false,
				'msg' => 'Something went wrong!',
			]));
		}
		echo json_encode([
			'status' => true,
			'msg' => 'Coupon deleted Successfully!',
			'title' => 'Deleted!',
		]);
	}
}
