<?php

class Kategori extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mod_home');
        $this->load->library('pagination');
    }

    function index()
    {
        //pagination
        $config['base_url'] = base_url('kategori/index');
        $config['total_rows'] = $this->mod_home->countAll();
        $config['per_page'] = 15;

        //style
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '<i class="fa fa-caret-right" aria-hidden="true"></i>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fa fa-caret-left" aria-hidden="true"></i>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</li></a>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['produk'] = $this->mod_home->getAllProduk($config['per_page'] = 15, $page);
        $data['topproduk'] = $this->mod_home->getProduk();
        $data['title'] = 'The Crabbys - Produk';
        $data['sort'] = '0';
        $id_member = $this->session->userdata('id');
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }

        $this->load->view('layoutweb/header', $data);
        $this->load->view('layoutweb/navsearch', $data);
        $this->load->view('layoutweb/produk/body', $data);
        $this->load->view('layoutweb/footer');
    }

    function rekomendasi()
    {
        $data['produk'] = $this->mod_home->getRekomendasiProduk();
        $data['topproduk'] = $this->mod_home->getProduk();
        $data['title'] = 'The Crabbys - Produk';
        $id_member = $this->session->userdata('id');
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }

        $this->load->view('layoutweb/header', $data);
        $this->load->view('layoutweb/navsearch', $data);
        $this->load->view('layoutweb/produk/rekomendasi', $data);
        $this->load->view('layoutweb/footer');
    }

    function byKategori()
    {
        $seo = $this->uri->segment(3);
        //get ID kategori
        $kategori = $this->db->get_where('tabel_kategori', array('kategori_nama_seo' => $seo))->row_array();
        $kategoriID = $kategori['kategori_id'];

        //pagination
        $config['base_url'] = base_url('kategori/produk/') . $seo;
        $config['total_rows'] = $this->mod_home->countAllByKategori($kategoriID);
        $config['per_page'] = 15;

        //style
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '<i class="fa fa-caret-right" aria-hidden="true"></i>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fa fa-caret-left" aria-hidden="true"></i>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</li></a>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        //get produk list
        $data['produk'] = $this->mod_home->getProdukByKategori($config['per_page'] = 15, $page, $kategoriID);
        $data['topproduk'] = $this->mod_home->getProduk();
        $data['title'] = 'The Crabbys - ' . $kategori['kategori_nama'];
        $id_member = $this->session->userdata('id');
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }

        $this->load->view('layoutweb/header', $data);
        $this->load->view('layoutweb/navsearch', $data);
        $this->load->view('layoutweb/produk/kategori', $data);
        $this->load->view('layoutweb/footer');
    }

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $produk = $this->mod_home->search($keyword);

        $hasil = $this->load->view('layoutweb/produk/search', array('produk' => $produk, 'keyword' => $keyword), true);

        $callback = array(
            'hasil' => $hasil,
        );
        echo json_encode($callback);
    }

    function sortbyLow()
    {
        //pagination
        $config['base_url'] = base_url('kategori/sortbyLow');
        $config['total_rows'] = $this->mod_home->countAll();
        $config['per_page'] = 15;

        //style
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '<i class="fa fa-caret-right" aria-hidden="true"></i>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fa fa-caret-left" aria-hidden="true"></i>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</li></a>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['produk'] = $this->mod_home->getAllProdukLow($config['per_page'] = 15, $page);
        $data['topproduk'] = $this->mod_home->getProduk();
        $data['title'] = 'The Crabbys - Produk';
        $data['sort'] = '1';
        $id_member = $this->session->userdata('id');
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }

        $this->load->view('layoutweb/header', $data);
        $this->load->view('layoutweb/navsearch', $data);
        $this->load->view('layoutweb/produk/body', $data);
        $this->load->view('layoutweb/footer');
    }

    function sortbyHigh()
    {
        //pagination
        $config['base_url'] = base_url('kategori/sortbyHigh');
        $config['total_rows'] = $this->mod_home->countAll();
        $config['per_page'] = 15;

        //style
        $config['full_tag_open'] = '<div class="pagination"><ul>';
        $config['full_tag_close'] = '</ul></div>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '<i class="fa fa-caret-right" aria-hidden="true"></i>';
        $config['next_tag_open'] = '<li class="next">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '<i class="fa fa-caret-left" aria-hidden="true"></i>';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</li></a>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';


        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['produk'] = $this->mod_home->getAllProdukHigh($config['per_page'] = 15, $page);
        $data['topproduk'] = $this->mod_home->getProduk();
        $data['title'] = 'The Crabbys - Produk';
        $data['sort'] = '2';
        $id_member = $this->session->userdata('id');
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }

        $this->load->view('layoutweb/header', $data);
        $this->load->view('layoutweb/navsearch', $data);
        $this->load->view('layoutweb/produk/body', $data);
        $this->load->view('layoutweb/footer');
    }
}
