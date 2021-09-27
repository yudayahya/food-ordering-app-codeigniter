<?php

class Varian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_varian');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Varian';
        $data['aktif'] = 'Varian';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/varian/data', $data);
    }

    public function ajax_list()
    {
        $list = $this->mod_varian->varian_list();
        $data = array();
        $no = 1;
        foreach ($list as $varian) {
            if ($varian->in_stock == 1) {
                $stock = '<span class="text-success"><strong>In Stock</strong></span>';
            } else {
                $stock = '<span class="text-danger"><strong>Out of Stock</strong></span>';
            }
            $row = array();
            $row[] = $no;
            $row[] = $varian->nama_varian  . ' (' . $stock . ') ';
            $row[] = $varian->harga;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $varian->varian_id . "'" . ',' . "'" . $varian->nama_varian . "'" . ',' . "'" . $varian->harga . "'" . ',' . "'" . $varian->in_stock . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $varian->varian_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function simpan_varian()
    {
        $this->form_validation->set_rules('namavarian', 'Nama Varian', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|is_natural');
        if ($this->form_validation->run()) {
            $nama = $this->input->post('namavarian');
            $harga = $this->input->post('harga');
            $cekboxstock = $this->input->post('cekboxstock');

            if ($cekboxstock == 'true') {
                $stock = 1;
            } else {
                $stock = 0;
            }

            $this->mod_varian->simpan($nama, $harga, $stock);
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
                'error_namavarian' => form_error('namavarian'),
                'error_harga' => form_error('harga'),
            );
        }

        echo json_encode($array);
    }

    function edit_varian()
    {
        $this->form_validation->set_rules('namavarianedit', 'Nama Varian', 'required');
        $this->form_validation->set_rules('hargaedit', 'Harga', 'required|is_natural');
        if ($this->form_validation->run()) {
            $nama = $this->input->post('namavarianedit');
            $harga = $this->input->post('hargaedit');
            $cekboxstock = $this->input->post('cekboxstock');

            if ($cekboxstock == 'true') {
                $stock = 1;
            } else {
                $stock = 0;
            }

            $this->mod_varian->edit($nama, $harga, $stock);
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
                'error_namavarian' => form_error('namavarianedit'),
                'error_harga' => form_error('hargaedit'),
            );
        }

        echo json_encode($array);
    }

    function hapus_varian()
    {
        $this->mod_varian->hapus($this->input->post('hapus'));
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
