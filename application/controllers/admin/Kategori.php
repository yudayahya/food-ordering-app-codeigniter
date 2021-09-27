<?php

class Kategori extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_kategori');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Kategori';
        $data['aktif'] = 'Kategori';
        $data['parent'] = $this->mod_kategori->select_parent()->result();
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/kategori/data', $data);
    }

    function getparent()
    {
        $parent = $this->mod_kategori->select_parent()->result();
        echo json_encode($parent);
    }

    public function ajax_list()
    {
        $list = $this->mod_kategori->kategori_list();
        $data = array();
        $no = 1;
        foreach ($list as $kategori) {
            if ($kategori->varian == 1) {
                $saos = '<span class="text-success"><strong> (Menggunakan Saos)</strong></span>';
            } else {
                $saos = '';
            }
            $row = array();
            $row[] = $no;
            $row[] = $kategori->kategori_nama . $saos;
            if ($kategori->parent == 0 || $kategori->parent == -1) {
                $row[] = "Menu Utama";
            } else {
                $parent = $this->db->get_where('tabel_kategori', array('kategori_id' => $kategori->parent))->row_array();
                $row[] = $parent['kategori_nama'];
            }
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $kategori->kategori_id . "'" . ',' . "'" . $kategori->kategori_nama . "'" . ',' . "'" . $kategori->parent . "'" . ',' . "'" . $kategori->varian . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $kategori->kategori_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function simpan_kategori()
    {
        $this->form_validation->set_rules('namakategori', 'Nama Kategori', 'required');
        if ($this->form_validation->run()) {
            $nama = $this->input->post('namakategori');
            $seo = seo_title($nama);
            $parent = $this->input->post('parent');
            $cekbox = $this->input->post('varian');
            if ($cekbox == 'true') {
                $varian = 1;
            } else {
                $varian = 0;
            }

            $this->mod_kategori->simpan($nama, $seo, $parent, $varian);
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
                'error_namakategori' => form_error('namakategori')
            );
        }

        echo json_encode($array);
    }

    function edit_kategori()
    {
        $this->form_validation->set_rules('namakategoriedit', 'Nama Kategori', 'required');
        if ($this->form_validation->run()) {
            $nama = $this->input->post('namakategoriedit');
            $seo = seo_title($nama);
            $parent = $this->input->post('parentedit');
            $cekbox = $this->input->post('varian');
            if ($cekbox == 'true') {
                $varian = 1;
            } else {
                $varian = 0;
            }

            $this->mod_kategori->edit($nama, $seo, $parent, $varian);
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
                'error_namakategori' => form_error('namakategoriedit')
            );
        }

        echo json_encode($array);
    }

    public function hapus_kategori()
    {
        $this->mod_kategori->hapus($this->input->post('hapus'));
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
