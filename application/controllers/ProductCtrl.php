<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProductCtrl extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::check();
    }
    public function index()
    {
        $layoutData['page'] = 'product/index';
        $layoutData['pageTitle'] = 'Manage Products - ' . WEBSITE_TITLE;
        $layoutData['pageData'] = array();
        $this->load->view('layout', $layoutData);
    }
    public function create()
    {
        $categories = Category::children()->get()->pluck('name', 'id');
        $this->load->view('product/add', ['categories' => $categories]);
    }
    public function edit($id)
    {
        $data['categories'] = Category::children()->get()->pluck('name', 'id');
        $data['record'] = Product::with('categories')->find($id)->toArray();
        $this->load->view('product/update', $data);
    }
    public function store()
    {
        $data = $this->input->post();
        if (in_array('', $data)) {
            exit(json_encode([
                "status" => false,
                "msg" => "Product data can not be empty!",
            ]));
        }
        $this->load->library('upload', $this->config->item('product_img_upload'));
        $file_names = [];
        $Imgs = count($_FILES['images']['name']);
        for ($i = 0; $i < $Imgs; $i++) {
            $_FILES['othrfile']['name'] = $_FILES['images']['name'][$i];
            $_FILES['othrfile']['type'] = $_FILES['images']['type'][$i];
            $_FILES['othrfile']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
            $_FILES['othrfile']['error'] = $_FILES['images']['error'][$i];
            $_FILES['othrfile']['size'] = $_FILES['images']['size'][$i];
            if ($this->upload->do_upload('othrfile')) {
                $file_names[] = $this->upload->data('file_name');
            } else {
                exit(json_encode([
                    'status' => false,
                    'msg' => $this->upload->display_errors(''),
                ]));
            }
        }
        $data['images'] = $file_names;
        $result = Product::create($data);
        if (!$result) {
            exit(json_encode([
                'status' => false,
                'msg' => 'Something went wrong!',
            ]));
        }
        $category = $this->input->post('category', true);
        if ($category) {
            ProductCategoryMap::create(['product_id' => $result->id, 'category_id' => $category]);
        }
        echo json_encode([
            'status' => true,
            'msg' => 'Product data inserted successfully!',
        ]);
    }
    public function update($id)
    {
        $data = $this->input->post();
        if (in_array('', $data)) {
            exit(json_encode([
                "status" => false,
                "msg" => "Product data can not be empty!",
            ]));
        }
        $img_config = $this->config->item('product_img_upload');
        $this->load->library('upload', $img_config);
        if (isset($_FILES['images']) && !empty($_FILES['images']) && $_FILES['images']['tmp_name'] != '' || $id == '') {
            $file_names = [];
            $Imgs = count($_FILES['images']['name']);
            for ($i = 0; $i < $Imgs; $i++) {
                $_FILES['othrfile']['name'] = $_FILES['images']['name'][$i];
                $_FILES['othrfile']['type'] = $_FILES['images']['type'][$i];
                $_FILES['othrfile']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
                $_FILES['othrfile']['error'] = $_FILES['images']['error'][$i];
                $_FILES['othrfile']['size'] = $_FILES['images']['size'][$i];
                if ($this->upload->do_upload('othrfile')) {
                    $file_names[] = $this->upload->data('file_name');
                } else {
                    exit(json_encode([
                        'status' => false,
                        'msg' => $this->upload->display_errors(''),
                    ]));
                }
            }
            $data['images'] = $file_names;
        }
        $product = Product::find($id);
        if(array_key_exists('images', $data)) {
            if(is_array($product->images)) {
                foreach($product->images as $img) {
                    unlink($img_config['upload_path'].$img);
                }
            }
        }
        $result = $product->update($data);
        if (!$result) {
            exit(json_encode([
                'status' => false,
                'msg' => 'Something went wrong!',
            ]));
        }
        $category = $this->input->post('category', true);
        if ($category) {
            ProductCategoryMap::where('product_id',$id)->delete();
            ProductCategoryMap::create(['product_id' => $product->id, 'category_id' => $category]);
        }
        echo json_encode([
            'status' => true,
            'msg' => 'Product data updated successfully!',
        ]);
    }
    public function get()
    {
        $draw = intval($this->input->get('draw', true));
        $this->load->model('CommonModel');
        $this->load->helper('datatable');
        $data = datatable($this->input->get());
        $data['table'] = ' products';
        $data['select'] = 'id, name, is_active, price, sub_title';
        $data['condition']['deleted_at'] = $condition['deleted_at'] = null;
        $recordTotal = $this->CommonModel->getDataCount($condition, 'products');
        $records = $this->CommonModel->datatableQueryBuilder($data, 'array');
        $filteredRecords = $this->CommonModel->datatableQueryBuilder($data, 'count');
        $records = array_map(function ($record) {
            $status = $record['is_active'] == 1 ? 'checked' : '';
            $id = $record['id'];
            $record['is_active'] = "<input type='checkbox' class='status-switch' $status data-id='$id' data-fouc>";
            $record['action'] = "
            <a href='javascript:void(0)' onclick='openModal(`Update Product`,`" . base_url("/product/$id/update") . "`,`md`)' title='Edit'><i class='text-info icon-pencil7'></i></a>
            <a href='javascript:void(0)' onclick='deleteProduct(`$id`)' title='Delete'><i class='text-danger icon-eraser2'></i></a>";
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
        $status = $this->input->post('status', true) == 'true' ? 1 : 0;
        $result = Product::find($id)->update(['is_active' => $status]);
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
        $product = Product::find($id);
        $img_config = $this->config->item('product_img_upload');
        if(is_array($product->images)) {
            foreach($product->images as $img) {
                unlink($img_config['upload_path'].$img);
            }
        }
        ProductCategoryMap::where('product_id', $product->id)->delete();
        $result = $product->delete();
        if (!$result) {
            exit(json_encode([
                'status' => false,
                'msg' => 'Something went wrong!',
            ]));
        }
        echo json_encode([
            'status' => true,
            'msg' => 'Product deleted Successfully!',
            'title' => 'Deleted!',
        ]);
    }
}
