<?php

class Profile extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_profile_admin', 'profile');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Profile';
        $data['aktif'] = 'Profile';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/profile/view_profile', $data);
    }


    public function edit_profile()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Edit Profile';
        $data['aktif'] = 'Profile';

        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->template->load('layoutadmin/templateadmin', 'layoutadmin/profile/view_edit', $data);
        } else {
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $pass = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            $this->profile->edit($id, $nama, $pass);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
            Kredensialitas Berhasil Diubah.
            </div>');
            redirect('admin/profile');
        }
    }

    function change_profile_picture()
    {
        $email = $this->session->userdata('email');
        $error = 'false';
        $config['upload_path'] = "./assets/gambar_admin";
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size']     = '1000';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("file_input")) {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
        } else {
            $error = 'true';
        }

        if ($error !== 'true') {
            $this->profile->upload_image($email, $image);
        }

        $output = array(
            "error"  => $error
        );
        echo json_encode($output);
    }
}
