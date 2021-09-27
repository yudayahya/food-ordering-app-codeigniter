<?php

class DataAdmin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_dataAdmin', 'dataAdmin');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Data Admin';
        $data['aktif'] = 'Data Admin';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/dataAdmin/view_dataAdmin', $data);
    }

    public function ajax_list()
    {
        $list = $this->dataAdmin->admin_list();
        $data = array();
        $no = 1;
        foreach ($list as $admin) {
            $row = array();
            $row[] = $no;
            $row[] = $admin->nama;
            $row[] = $admin->username;
            $row[] = $admin->email;
            $row[] = '<img src="' . base_url() . 'assets/gambar_admin/' . $admin->image . '" style="width: 100%; max-width:100px; height: auto">';

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $admin->id . "'" . ',' . "'" . $admin->nama . "'" . ',' . "'" . $admin->image . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $admin->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function simpan_admin()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[tabel_admin.username]', [
            'is_unique' => 'This username has already used!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tabel_admin.email]', [
            'is_unique' => 'This email has already used!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run()) {
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $pass = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $role = '2';

            $config['upload_path'] = "./assets/gambar_admin";
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("image")) {
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
            } else {
                $image = 'default.png';
            }

            $this->dataAdmin->simpan($nama, $username, $email, $pass, $image, $role);


            $array = array(
                'success' => '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                            Data Berhasil Dimasukan.
                            </div>'
            );
        } else {
            $array = array(
                'error' => true,
                'error_nama' => form_error('nama'),
                'error_username' => form_error('username'),
                'error_email' => form_error('email'),
                'error_password1' => form_error('password1'),
                'error_password2' => form_error('password2'),
            );
        }

        echo json_encode($array);
    }

    public function edit_admin()
    {
        $this->form_validation->set_rules('namaedit', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('password1edit', 'Password', 'required|trim|min_length[3]|matches[password2edit]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2edit', 'Password', 'required|trim|matches[password1edit]');

        if ($this->form_validation->run()) {
            $id = $this->input->post('kode');
            $nama = $this->input->post('namaedit');
            $pass = password_hash($this->input->post('password1edit'), PASSWORD_DEFAULT);

            $config['upload_path'] = "./assets/gambar_admin";
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("imageedit")) {
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
            } else {
                $image = $this->input->post('imagename');
            }

            $this->dataAdmin->edit($id, $nama, $pass, $image);


            $array = array(
                'success' => '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                            Data Berhasil Diubah.
                            </div>'
            );
        } else {
            $array = array(
                'error' => true,
                'error_nama' => form_error('namaedit'),
                'error_password1' => form_error('password1edit'),
                'error_password2' => form_error('password2edit'),
            );
        }

        echo json_encode($array);
    }

    public function hapus_admin()
    {
        $this->dataAdmin->hapus($this->input->post('hapus'));
        $array = array(
            'success' => '<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Notifikasi!</h4>
                        Data Berhasil Dihapus.
                        </div>'
        );

        echo json_encode($array);
    }
}
