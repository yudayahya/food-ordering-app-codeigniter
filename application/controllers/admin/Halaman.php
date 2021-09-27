<?php

class Halaman extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_halaman');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Halaman';
        $data['aktif'] = 'Halaman';
        $data['record'] = $this->mod_halaman->select_all();
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/halaman/data', $data);
    }

    public function ajax_list()
    {
        $list = $this->mod_halaman->select_all();
        $data = array();
        $no = 1;
        foreach ($list as $hal) {
            $row = array();
            $row[] = $no;
            $row[] = $hal->judul;
            $row[] = base_url() . 'p/' . $hal->judul_seo;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $hal->pages_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $hal->pages_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function post()
    {
        if (isset($_POST['submit'])) {
            $this->mod_halaman->simpan();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
            Halaman Berhasil Ditambah.
            </div>');
            redirect('admin/halaman');
        } else {
            $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['title'] = 'Halaman';
            $data['aktif'] = 'Halaman';
            $this->template->load('layoutadmin/templateadmin', 'layoutadmin/halaman/post', $data);
        }
    }

    function edit()
    {
        if (isset($_POST['submit'])) {
            $this->mod_halaman->edit();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
            Halaman Berhasil Diubah.
            </div>');
            redirect('admin/halaman');
        } else {
            $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['title'] = 'Edit Halaman';
            $data['aktif'] = 'Halaman';
            $id = $this->uri->segment(4);
            $data['row'] = $this->db->get_where('tabel_pages', array('pages_id' => $id))->row_array();
            $this->template->load('layoutadmin/templateadmin', 'layoutadmin/halaman/edit', $data);
        }
    }

    function hapus()
    {
        $this->db->where('pages_id', $this->input->post('hapus'));
        $this->db->delete('tabel_pages');
        $array = array(
            'success' => '<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Notifikasi!</h4>
                        Halaman Berhasil Dihapus.
                        </div>'
        );

        echo json_encode($array);
    }
}
