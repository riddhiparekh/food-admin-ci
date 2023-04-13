<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WebsiteController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::check();
        $this->load->model('CommonModel');
        // $table = 'web_content';
    }
    public function about()
    {
        $con['type'] = 'about';
        if( $this->input->post('type') == 'about' ){
            $content['title'] = $this->input->post('title');
            $content['content'] = $this->input->post('content');
            $data['content'] = json_encode($content);
            $updateAbout = $this->CommonModel->updateData($con,$data,'web_content');
            if($updateAbout){
                $this->session->set_flashdata('success','Data Updated Successfully.');
            }else{
                $this->session->set_flashdata('fail','Something went wrong!');
            }
        }
        $layoutData['page'] = 'website/about';
        $layoutData['pageTitle'] = 'Manage Website - ' . WEBSITE_TITLE;
        $select = 'id, type, content';
        $layoutData['pageData'] = $this->CommonModel->getSelData($select, $con, 'web_content');
        $this->load->view('layout', $layoutData);
    }
    public function features()
    {
        $con['type'] = 'features';
        if( $this->input->post('type') == 'features' ){
            $content['title'] = $this->input->post('title');
            $content['content'] = $this->input->post('content');
            for($i=1; $i <= 6; $i++ ){
                $content['icon'.$i] = $this->input->post('icon'.$i);
                $content['heading'.$i] = $this->input->post('heading'.$i);
                $content['description'.$i] = $this->input->post('description'.$i);
            }
            
            $data['content'] = json_encode($content);
            $updateAbout = $this->CommonModel->updateData($con,$data,'web_content');
            if($updateAbout){
                $this->session->set_flashdata('success','Data Updated Successfully.');
            }else{
                $this->session->set_flashdata('fail','Something went wrong!');
            }
        }
        $layoutData['page'] = 'website/features';
        $layoutData['pageTitle'] = 'Manage Website - ' . WEBSITE_TITLE;
        $select = 'id, type, content';
        
        $layoutData['pageData'] = $this->CommonModel->getSelData($select, $con, 'web_content','array');
        $this->load->view('layout', $layoutData);
    }
    public function benifits()
    {
        $con['type'] = 'benifits';
        if( $this->input->post('type') == 'benifits' ){
            $content['title'] = $this->input->post('title');
            $content['content'] = $this->input->post('content');
            for($i=1; $i <= 6; $i++ ){
                $content['icon'.$i] = $this->input->post('icon'.$i);
                $content['heading'.$i] = $this->input->post('heading'.$i);
                $content['description'.$i] = $this->input->post('description'.$i);
            }
            
            $data['content'] = json_encode($content);
            $updateAbout = $this->CommonModel->updateData($con,$data,'web_content');
            if($updateAbout){
                $this->session->set_flashdata('success','Data Updated Successfully.');
            }else{
                $this->session->set_flashdata('fail','Something went wrong!');
            }
        }
        $layoutData['page'] = 'website/benifits';
        $layoutData['pageTitle'] = 'Manage Website - ' . WEBSITE_TITLE;
        $select = 'id, type, content';
        
        $layoutData['pageData'] = $this->CommonModel->getSelData($select, $con, 'web_content');
        $this->load->view('layout', $layoutData);
    }
    public function feedbacks()
    {
        $layoutData['page'] = 'website/feedbacks';
        $layoutData['pageTitle'] = 'Manage Website - ' . WEBSITE_TITLE;
        $select = 'id, type, content';
        $con['type'] = 'feedbacks'; 
        
        $layoutData['pageData'] = $this->CommonModel->getSelData($select, $con, 'web_content');
        $this->load->view('layout', $layoutData);
    }
    public function downloads()
    {
        $con['type'] = 'download';
        if( $this->input->post('type') == 'download' ){
            $content['title'] = $this->input->post('title');
            $content['content'] = $this->input->post('content');
            $content['link'] = $this->input->post('link');
            $data['content'] = json_encode($content);
            $updateDownload = $this->CommonModel->updateData($con,$data,'web_content');
            if($updateDownload){
                $this->session->set_flashdata('success','Data Updated Successfully.');
            }else{
                $this->session->set_flashdata('fail','Something went wrong!');
            }
        }
        $layoutData['page'] = 'website/downloads';
        $layoutData['pageTitle'] = 'Manage Website - ' . WEBSITE_TITLE;
        $select = 'id, type, content';
        
        $layoutData['pageData'] = $this->CommonModel->getSelData($select, $con, 'web_content');
        $this->load->view('layout', $layoutData);
    }
    public function contact()
    {
        $layoutData['page'] = 'website/contact';
        $layoutData['pageTitle'] = 'Manage Website - ' . WEBSITE_TITLE;
        $select = 'id, type, content';
        $con['type'] = 'contact'; 
        
        $layoutData['pageData'] = $this->CommonModel->getSelData($select, $con, 'web_content');
        $this->load->view('layout', $layoutData);
    }
}
