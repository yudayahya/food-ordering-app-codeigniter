<?php

class Barang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_barang', 'barang');
        $this->load->model('mod_kategori');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Produk';
        $data['aktif'] = 'Produk';
        $data['kategori'] = $this->mod_kategori->kategori_list_barang();
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/barang/view_barang', $data);
    }

    public function ajax_list()
    {
        $list = $this->barang->barang_list();
        $data = array();
        $no = 1;
        foreach ($list as $barang) {
            if ($barang->in_stock == 1) {
                $stock = '<span class="text-success"><strong>In Stock</strong></span>';
            } else {
                $stock = '<span class="text-danger"><strong>Out of Stock</strong></span>';
            }
            if ($barang->seller == 1) {
                $rekomen = '<strong>(Produk Unggulan)</strong>';
            } else {
                $rekomen = '';
            }
            $row = array();
            $row[] = $no;
            $row[] = $barang->produk_nama . ' (' . $stock . ') ' . $rekomen;
            $row[] = $barang->harga;
            $row[] = $barang->kategori_nama;
            $row[] = '<img src="' . base_url() . 'assets/gambar_produk/' . $barang->gambar . '" style="width: 100%; max-width:100px; height: auto">';

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' . "'" . $barang->produk_id . "'" . ',' . "'" . $barang->produk_nama . "'" . ',' . "'" . $barang->harga . "'" . ',' . "'" . $barang->kategori_id . "'" . ',' . "'" . $barang->gambar . "'" . ',' . "'" . $barang->seller . "'" . ',' . "'" . $barang->in_stock . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                    <a class="btn btn-sm btn-primary" href="' . base_url('admin/barang/keterangan/') . $barang->produk_id . '" title="Keterangan"><i class="glyphicon glyphicon-pencil"></i> Keterangan</a>
                    <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $barang->produk_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function simpan_barang()
    {
        $this->form_validation->set_rules('namabarang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('hargabarang', 'Harga Barang', 'required|is_natural');
        if ($this->form_validation->run()) {
            $nabar = $this->input->post('namabarang');
            $harga = $this->input->post('hargabarang');
            $seo = seo_title($nabar);
            $kategori = $this->input->post('kategoribarang');
            $cekbox = $this->input->post('cekbox');
            $cekboxstock = $this->input->post('cekboxstock');
            if ($cekbox == 'true') {
                $seller = 1;
            } else {
                $seller = 0;
            }

            if ($cekboxstock == 'true') {
                $stock = 1;
            } else {
                $stock = 0;
            }

            $config['upload_path'] = "./assets/gambar_produk";
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("image")) {
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
            } else {
                $image = 'default.png';
            }

            $this->barang->simpan_barang($nabar, $harga, $seo, $image, $kategori, $seller, $stock);


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
                'error_namabarang' => form_error('namabarang'),
                'error_hargabarang' => form_error('hargabarang'),
            );
        }

        echo json_encode($array);
    }

    public function edit_barang()
    {
        $this->form_validation->set_rules('namabarangedit', 'Nama Barang', 'required');
        $this->form_validation->set_rules('hargabarangedit', 'Harga Barang', 'required|is_natural');
        if ($this->form_validation->run()) {
            $id = $this->input->post('kode');
            $nabar = $this->input->post('namabarangedit');
            $harga = $this->input->post('hargabarangedit');
            $seo = seo_title($nabar);
            $kategori = $this->input->post('kategoribarangedit');
            $cekbox = $this->input->post('cekbox');
            $cekboxstock = $this->input->post('cekboxstock');
            if ($cekbox == 'true') {
                $seller = 1;
            } else {
                $seller = 0;
            }
            if ($cekboxstock == 'true') {
                $stock = 1;
            } else {
                $stock = 0;
            }

            $config['upload_path'] = "./assets/gambar_produk";
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("imageedit")) {
                $data = array('upload_data' => $this->upload->data());
                $image = $data['upload_data']['file_name'];
            } else {
                $image = $this->input->post('imagename');
            }

            $this->barang->edit_barang($id, $nabar, $harga, $seo, $image, $kategori, $seller, $stock);


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
                'error_namabarang' => form_error('namabarangedit'),
                'error_hargabarang' => form_error('hargabarangedit'),
            );
        }

        echo json_encode($array);
    }

    public function hapus_barang()
    {
        $this->barang->hapus_barang($this->input->post('hapus'));
        $array = array(
            'success' => '<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Notifikasi!</h4>
                        Data Berhasil Dihapus.
                        </div>'
        );

        echo json_encode($array);
    }

    function keterangan()
    {
        if (isset($_POST['submit'])) {
            $this->barang->keterangan();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
            Keterangan barang berhasil diubah.
            </div>');
            redirect('admin/barang');
        } else {
            $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['title'] = 'Ubah Keterangan Produk';
            $data['aktif'] = 'Produk';
            $id = $this->uri->segment(4);
            $data['row'] = $this->db->get_where('tabel_produk', array('produk_id' => $id))->row_array();
            $this->template->load('layoutadmin/templateadmin', 'layoutadmin/barang/keterangan', $data);
        }
    }
}
