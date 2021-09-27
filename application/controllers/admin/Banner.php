<?php

class Banner extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_banner', 'banner');
        $this->load->model('mod_barang', 'barang');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Banner';
        $data['aktif'] = 'Banner';
        $data['produk'] = $this->barang->barang_list();
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/banner/view_banner', $data);
    }

    public function ajax_list()
    {
        $list = $this->banner->banner_list();
        $data = array();
        $no = 1;
        foreach ($list as $banner) {
            $produk = $this->db->get_where('tabel_produk', array('produk_nama' => $banner->nama_banner))->row_array();
            $row = array();
            $row[] = $no;
            $row[] = $banner->nama_banner;
            $row[] = $banner->keterangan;
            $row[] = '<img src="' . base_url() . 'assets/banner/' . $banner->image . '" style="width: 100%; max-width:100px; height: auto">';

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $banner->id . "'" . ',' . "'" . $produk['produk_id'] . "'" . ',' . "'" . $banner->keterangan . "'" . ',' . "'" . $banner->image . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $banner->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function simpan_banner()
    {
        $this->form_validation->set_rules('keterangan', 'Keterangan Banner', 'required');
        if ($this->form_validation->run()) {
            $judul = $this->input->post('judultext');
            $ket = $this->input->post('keterangan');
            $seo = seo_title($judul);

            $config['upload_path'] = "./assets/banner";
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("image")) {
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
            } else {
                $image = 'default.png';
            }

            $this->banner->simpan_banner($judul, $seo, $ket, $image);


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
                'error_keterangan' => form_error('keterangan'),
            );
        }

        echo json_encode($array);
    }

    public function edit_banner()
    {
        $this->form_validation->set_rules('keteranganedit', 'Keterangan Banner', 'required');
        if ($this->form_validation->run()) {
            $id = $this->input->post('kode');
            $judul = $this->input->post('judultext');
            $ket = $this->input->post('keteranganedit');
            $seo = seo_title($judul);

            $config['upload_path'] = "./assets/banner";
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("imageedit")) {
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
            } else {
                $image = $this->input->post('imagename');
            }

            $this->banner->edit_banner($id, $judul, $seo, $ket, $image);


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
                'error_keterangan' => form_error('keteranganedit'),
            );
        }

        echo json_encode($array);
    }

    public function hapus_banner()
    {
        $this->banner->hapus_banner($this->input->post('hapus'));
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
