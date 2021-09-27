<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('admin/profile');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'The Crabbys Management System - Admin Login';
            $this->load->view('layoutadmin/auth/auth_header', $data);
            $this->load->view('layoutadmin/auth/login');
            $this->load->view('layoutadmin/auth/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tabel_admin', ['username' => $username])->row_array();

        //jika user ada
        if ($user) {
            //cek password
            if (password_verify($password, $user['password'])) {
                //sukses
                $data = [
                    'email' => $user['email'],
                    'nama' => $user['nama'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('admin/profile');
                } else {
                    redirect('admin/profile');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong password!</div>');
                redirect('admin/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Admin is not registered! please contact owner for more info.</div>');
            redirect('admin/auth');
        }
    }

    public function blocked()
    {
        $this->load->view('layoutadmin/auth/blocked');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->unset_userdata('nama');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        You have been loged out!</div>');
        redirect('admin/auth');
    }
}
