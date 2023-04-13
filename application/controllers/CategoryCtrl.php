<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CategoryCtrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::check();
    }
    public function index()
    {
        $layoutData['page'] = 'category/index';
        $layoutData['pageTitle'] = 'Manage Categories - ' . WEBSITE_TITLE;
        $layoutData['pageData'] = array();
        $this->load->view('layout', $layoutData);
    }
    public function create()
    {
        $categories = Category::where('parent_id', null)->get()->pluck('name', 'id');
        $this->load->view('category/add', ['categories' => $categories]);
    }
    public function edit($id)
    {
        $this->load->model('CommonModel');
        $data['categories'] = Category::parent()->get()->pluck('name', 'id');
        $data['record'] = $this->CommonModel->getSingleData(['id' => $id], ' categories');
        $this->load->view('category/update', $data);
    }
    public function store()
    {
        $this->load->model('CommonModel');
        $categoryData = [];
        $categoryData['name'] = trim($this->input->post('name', true));
        $categoryData['sub_title'] = trim($this->input->post('subtitle', true));
        $categoryData['description'] = trim($this->input->post('description', true));
        if (in_array('', $categoryData)) {
            exit(json_encode([
                    "status" => false,
                    "msg" => "Category data can not be empty!",
                ]));
        }
        $categoryData['parent_id'] = $this->input->post('parent_id', true) ? : null;
        $this->load->library('upload' ? : null, $this->config->item('category_banner_upload'));
        if ($this->upload->do_upload('image')) {
            $categoryData['image'] = $this->upload->data('file_name');
            $result = $this->CommonModel->InsertData($categoryData, 'categories');
            $id = $this->db->insert_id();
        } else {
            echo json_encode([
                "status" => false,
                "msg" => $this->upload->display_errors(''),
            ]);
            exit();
        }
        if ($result) {
            echo json_encode([
                "status" => true,
                "msg" => "Category Saved!",
                "data" => [
                    'id' => $id,
                    'value' => $categoryData['name'],
                ],
            ]);
            exit();
        } else {
            echo json_encode([
                "status" => false,
                "msg" => "Something Went wrong!",
            ]);
            exit();
        }
    }
    public function update($id)
    {
        $this->load->model('CommonModel');
        $categoryData = [];
        $categoryData['name'] = trim($this->input->post('name', true));
        $categoryData['sub_title'] = trim($this->input->post('subtitle', true));
        $categoryData['description'] = trim($this->input->post('description', true));
        if (in_array('', $categoryData)) {
            echo json_encode([
                "status" => false,
                "msg" => "Category data can not be empty!",
            ]);
            exit();
        }
        $categoryData['parent_id'] = trim($this->input->post('parent_id', true)) ? : null;
        $this->load->library('upload', $this->config->item('category_banner_upload'));
        if (isset($_FILES['image']) && !empty($_FILES['image']) && $_FILES['image']['tmp_name'] != '' || $id == '') {
            if ($this->upload->do_upload('image')) {
                $path = $this->config->item('category_banner_upload')['upload_path'];
                $categoryImgData = $this->CommonModel->getSingleData(['id' => $id], 'categories', 'image');
                $image_name = $categoryImgData['image'];
                $categoryData['image'] = $this->upload->data('file_name');
            } else {
                echo json_encode([
                    "status" => false,
                    "msg" => $this->upload->display_errors(''),
                ]);
                exit();
            }
        }
        $categoryCondition['id'] = $id;
        $result = $this->CommonModel->updateData($categoryCondition, $categoryData, 'categories');
        if ($result) {
            if (isset($image_name)) {
                unlink($path . $image_name);
            }
            echo json_encode([
                "status" => true,
                "msg" => "Category Updated!",
                "data" => [
                    'id' => $id,
                    'value' => $categoryData['name'],
                ],
            ]);
            exit();
        } else {
            echo json_encode([
                "status" => false,
                "msg" => "Something Went wrong!",
            ]);
            exit();
        }
    }
    public function get()
    {
        $draw = intval($this->input->get('draw', true));
        $this->load->model('CommonModel');
        $this->load->helper('datatable');
        $data = datatable($this->input->get());
        $data['table'] = ' categories';
        $data['select'] = 'id, name, is_active, image, sub_title';
        $data['condition']['deleted_at'] = $condition['deleted_at'] = null;
        $recordTotal = $this->CommonModel->getDataCount($condition, 'categories');
        $records = $this->CommonModel->datatableQueryBuilder($data, 'array');
        $filteredRecords = $this->CommonModel->datatableQueryBuilder($data, 'count');
        $records = array_map(function ($record) {
            $status = $record['is_active'] == 1 ? 'checked' : '';
            $id = $record['id'];
            $record['image'] = "<img src=" . ASSET_URL . 'images/category/' . $record['image'] . " height= '100px' width= 'auto'>";
            $record['is_active'] = "<input type='checkbox' class='status-switch' $status data-id='$id' data-fouc>";
            $record['action'] = "<a href='javascript:void(0)' onclick='openModal(`Update Category`,`" . base_url("/category/$id/update") . "`,`sm`)' title='Edit'><i class='text-info icon-pencil7'></i></a>
            <a href='javascript:void(0)' onclick='deleteCategory(`$id`)' title='Delete'><i class='text-danger icon-eraser2'></i></a>";
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
    public function toggle($id)
    {
        $this->load->model('CommonModel');
        $status = $this->input->post('status', true) == 'true' ? 1 : 0;
        $result = $this->CommonModel->updateData(['id' => $id], ['is_active' => $status], ' categories');
        if ($result) {
            echo json_encode([
                'status' => true,
                'msg' => 'Data updated Successfully!',
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg' => 'Something Went Wrong!',
            ]);
        }
    }
    public function remove($id)
    {
        $this->load->model('CommonModel');
        $categoryImgData = $this->CommonModel->getSingleData(['id' => $id], 'categories', 'image');
        $categoryData['deleted_at'] = date('Y-m-d H:i:s');
        $categoryData['image'] = '';
        $delete = $this->CommonModel->updateData(['id' => $id], $categoryData, 'categories');
        if ($delete) {
            $path = $this->config->item('category_banner_upload')['upload_path'];
            $image_name = $categoryImgData['image'];
            if (isset($image_name)) {
                unlink($path . $image_name);
            }
            echo json_encode([
                'status' => 'success',
                'msg' => 'Category deleted Successfully!',
                'title' => 'Deleted!',
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'msg' => 'Something Went Wrong!',
                'title' => 'Oops...',
            ]);
        }
    }
}
