<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('barang_m');
        if (!$this->session->userdata('is_login')) {
            redirect('login');
        }
    }

    public function index() {
        $this->template->load('pages/barang_ajax/index');
    }

    public function get_data() {
        $barang = $this->barang_m->get_all();

        $return['data'] = [];
        $no = 1;
        foreach ($barang as $value) {
            $value->no = $no;
            $value->foto = '<img src="' . base_url('assets/images/') . $value->foto . '" width="60">';
            $value->action = '<button class="btn btn-warning" onclick="edit(\'' . $value->id . '\')">Edit</button>&nbsp;'
                    . '<button class="btn btn-danger" onclick="remove(\'' . $value->id . '\')">Delete</button>';
            array_push($return['data'], $value);
            $no++;
        }
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($return));
    }

    public function store() {
    
        $post = $this->input->post();

        $config['upload_path'] = './assets/images';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '1024';

        $this->load->library('upload',$config);
        if ($this->upload->do_upload('foto')) {
            $upload = $this->upload->data();
            $post['foto'] = $upload['file_name'];
            $insert = $this->barang_m->insert($post);

            if ($insert) {
                $response = [
                    "status" => "success",
                    "status_code" => 1,
                    "message" => "Berhasil Menambah Data"
                ];
            } else {
                $response = [
                    "status" => "fai",
                    "status_code" => 0,
                    "message" => "Gagal Menambah Data"
                ];
            }

        }else {
            $response = [
                    "status" => "fail",
                    "status_code" => 0,
                    "message" => $this->upload->display_errors()
                ];
        }

         $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

    public function edit($id)
    {
        $barang = $this->barang_m->get_by_id($id);

        if ($barang) {
            $response = [
                "status" => "success",
                "status_code" => 1,
                "message" => "Berhasil Get Data",
                "data" => $barang
            ];
        } else {
            $response =[
                "status" => "fail",
                "status_code" => 0,
                "message" => "Gagal Get Data",
            ];
        }

         $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));        
    }

    public function update($id){

        $post = $this->input->post();

        $config['upload_path'] = './assets/images';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '1024';

        $this->load->library('upload', $config);
        if (file_exists($_FILES['foto']['tmp_name'])) {
            if ($this->upload->do_upload('foto')) {
                $upload = $this->upload->data();
                $post['foto'] = $upload['file_name'];
            } else {
               $response = [
                "status" => "fail",
                "status_code" => 0,
                "message" => $this->upload->display_errors()
               ];

               $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));

                return;
            }
        }

        $update = $this->barang_m->update($id, $post);

        if ($update) {
            $response = [
                "status" => "success",
                "status_code" => 1,
                "message" => "Data Berhasil Disimpan",
                "data" => $barang
            ];

        } else {
            
            $response =[
                "status" => "fail",
                "status_code" => 0,
                "message" => "Gagal Menyimpan Data",
            ];
        }

         $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
    }

    public function delete($id){
        $result = $this->barang_m->delete($id);
        if ($result) {
             $response = [
                "status" => "success",
                "status_code" => 1,
                "message" => "Data Berhasil Dihapus",
                "data" => $barang
            ];

        } else {
            $response =[
                "status" => "fail",
                "status_code" => 0,
                "message" => "Gagal Menghapus Data",
            ];

        }

         $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response)); 
    }

}