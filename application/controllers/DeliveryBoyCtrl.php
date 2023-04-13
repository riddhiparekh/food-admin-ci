<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DeliveryBoyCtrl extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		Auth::check();
	}
	public function index()
	{
		$layoutData['page'] = 'delivery_boy/index';
		$layoutData['pageTitle'] = 'Manage Delivery Boys - ' . WEBSITE_TITLE;
		$layoutData['pageData'] = array();
		$this->load->view('layout', $layoutData);
	}
	public function create()
	{
		$this->load->view('delivery_boy/add');
	}
	public function edit($id)
	{
        $data['record'] = User::join('profiles', 'profiles.user_id', '=', 'users.id')
            ->select('id','contact_no', 'email', 'name')
            ->where('id',$id)
            ->first()->toArray();
		$this->load->view('delivery_boy/update', $data);
	}
	public function store()
	{
        $this->load->library('Password');
        $roleData = Role::where('role_slug','delivery-boy')->first()->toArray();
        $user_data['oauth_provider'] = 'local';
        $user_data['contact_no'] = $this->input->post('contact_no');
        $user_data['email'] = $this->input->post('email');
        $user_data['secret_key'] = $this->password->hash($this->input->post('password'));
        $user_data['verified_on'] = date('Y-m-d H:i:s');
        $userResult = User::create($user_data);
        $profile_data['role'] = $roleData['id'];
        $profile_data['name'] = $this->input->post('name');
        $profile_data['user_id'] = $userResult->id;
		if (in_array('', $profile_data) || in_array('', $user_data)) {
			exit(json_encode([
				"status" => false,
				"msg" => "Delivery boy data can not be empty!",
			]));
		}
		$result = Profile::create($profile_data);
		if (!$result) {
			exit(json_encode([
				'status' => false,
				'msg' => 'Something went wrong!',
			]));
		}
		echo json_encode([
			'status' => true,
			'msg' => 'Delivery boy inserted successfully!',
		]);
	}
	public function update($id)
	{
        $user_data['contact_no'] = $this->input->post('contact_no');
        $user_data['email'] = $this->input->post('email');
        $profile_data['name'] = $this->input->post('name');
		if (in_array('', $user_data) || in_array('', $profile_data)) {
			exit(json_encode([
				"status" => false,
				"msg" => "Delivery boy data can not be empty!",
			]));
		}
		$user = User::find($id);
		$result = $user->update($user_data);
		$profile = Profile::find($id);
		$result1 = $profile->update($profile_data);
		if (!$result || !$result1) {
			exit(json_encode([
				'status' => false,
				'msg' => 'Something went wrong!',
			]));
		}
		echo json_encode([
			'status' => true,
			'msg' => 'Delivery boy updated successfully!',
		]);
	}
	public function get()
	{
        $roleData = Role::where('role_slug','delivery-boy')->first()->toArray();
		$draw = intval($this->input->get('draw', true));
		$this->load->model('CommonModel');
		$this->load->helper('datatable');
		$data = datatable($this->input->get());
        $data['table'] = 'users';
        $joins[0] = [
            'table' => 'profiles as pro',
            'on' => 'pro.user_id = users.id',
            'type' => 'inner'
        ];
		$data['select'] = 'id,contact_no, email, name';
		$data['condition']['users.deleted_at'] = $condition['users.deleted_at'] = null;
		$data['condition']['pro.role'] = $condition['pro.role'] = $roleData['id'];
		$recordTotal = $this->CommonModel->getDataCount($condition, 'users', $joins);
		$records = $this->CommonModel->datatableQueryBuilder($data, 'array', $joins);
		$filteredRecords = $this->CommonModel->datatableQueryBuilder($data, 'count', $joins);
		$records = array_map(function ($record) {
			$id = $record['id'];
			$record['action'] = "
			<a href='javascript:void(0)' onclick='openModal(`Update Delivery boy`,`" . base_url("/delivery-boy/$id/update") . "`,`md`)' title='Edit'><i class='text-info icon-pencil7'></i></a>
			<a href='javascript:void(0)' onclick='deleteDelivery_Boy(`$id`)' title='Delete'><i class='text-danger icon-eraser2'></i></a>";
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
		$delivery_boy = User::find($id);
		$delivery_boy_profile = Profile::find($id);
        $result = $delivery_boy->delete();
        $result1 = $delivery_boy_profile->delete();
		if (!$result || !$result1) {
			exit(json_encode([
				'status' => false,
				'msg' => 'Something went wrong!',
			]));
		}
		echo json_encode([
			'status' => true,
			'msg' => 'Delivery boy deleted Successfully!',
			'title' => 'Deleted!',
		]);
	}
}
