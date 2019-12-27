<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_m');
        $this->load->model('role_m');
        if (!$this->session->userdata('is_login')) {
            redirect('login');
        }
    }

    public function index() {
       /* if (!$this->auth->privilege_check('user', 'read')) {
            $this->auth->no_access();
        }*/

        $user = $this->user_m->get_all();

        $this->template->load('pages/user/index', ['data' => $user]);
    }

    public function create() {
        /*if (!$this->auth->privilege_check('user', 'create')) {
            $this->auth->no_access();
        }*/

        $role = $this->role_m->get_all();
        $this->template->load('pages/user/create', ['role' => $role]);
    }

    public function store() {
        $post = $this->input->post();
        

        $config['upload_path'] = './assets/profil';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '1024';

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('foto')) {
            $upload = $this->upload->data();
            $post['password'] = hash('sha512', $post['password']);
            $post['foto'] = $upload['file_name'];
            $this->user_m->insert($post);
            redirect('user');
        } else {
            print_r($this->upload->display_errors());
        }
    }

    public function edit($id) {
        /*if (!$this->auth->privilege_check('user', 'update')) {
            $this->auth->no_access();
        }*/
        $user = $this->user_m->get_by_id($id);
        $role = $this->role_m->get_all();

        $this->template->load('pages/user/edit', ['data' => $user, 'role' => $role]);
    }

    public function update($id) {
        $post = $this->input->post();

        $config['upload_path'] = './assets/profil';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '1024';

        $this->load->library('upload', $config);
        if (file_exists($_FILES['foto']['tmp_name'])) {
            if ($this->upload->do_upload('foto')) {
                $upload = $this->upload->data();
                $post['foto'] = $upload['file_name'];
            } else {
                print_r($this->upload->display_errors());
            }
        }

        $this->user_m->update($id, $post);
        redirect('user');
    }

    public function delete($id) {
        if (!$this->auth->privilege_check('user', 'delete')) {
            $this->auth->no_access();
        }
        $result = $this->user_m->delete($id);
        if ($result) {
            redirect('user');
        }
    }

}
