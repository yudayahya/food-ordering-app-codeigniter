<?php
class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mod_home');
    }

    function index()
    {
        $data['produk'] = $this->mod_home->getProduk();
        $data['newproduk'] = $this->mod_home->getNewProduk();
        $data['banner'] = $this->db->order_by('id', 'DESC')->get('tabel_banner')->result_array();
        $data['title'] = 'The Crabbys - Home';
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
        $this->load->view('layoutweb/navbar', $data);
        $this->load->view('layoutweb/banner', $data);
        $this->load->view('layoutweb/body', $data);
        $this->load->view('layoutweb/footer');
    }

    public function show_cart()
    {
        $list = $this->cart->contents();
        $record = count($list);
        $output = '';
        $subtotal = 0;
        $total = 0;
        if (!$list) {
            $output .= '<ul class="mini-products-list" id="cart-list">
            <li class="item">
            <div class="product-details"><label>Keranjang anda kosong.</label>
            </div>
            </li>
            </ul>';
        } else {
            foreach ($list as $items) {
                $saos = $this->db->get_where('tabel_varian_saus', array('varian_id' => $items['options']['varian_id']))->row_array();
                $produk = $this->db->get_where('tabel_produk', ['produk_id' => $items['id']])->row_array();

                if ($saos) {
                    $harga = number_format($items['price'] + $saos['harga'], 0, ".", ".");
                } else {
                    $harga = number_format($items['price'], 0, ".", ".");
                }
                $output .= '
                <ul class="mini-products-list" id="cart-list">
                <li class="item">
                    <a class="product-image">
                        <img src="' . base_url('assets/gambar_produk/') . $produk['gambar'] . '" title="" />
                    </a>
                    <div class="product-details">
                        <a href="#;" id="' . $items['rowid'] . '" class="hapus_cart remove"><i class="anm anm-times-l" aria-hidden="true"></i></a>
                        <a class="pName" href="' . base_url('produk/detail/') . $produk['produk_nama_seo'] . '">' . $items['name'] . '</a>
                        <div class="priceRow">
                            <div class="product-price">
                                <span class="money">Rp. ' . $harga . ' x ' . $items['qty'] . '</span>
                            </div>
                        </div>
                        
                ';
                if ($saos) {
                    $subtotal = ($items['price'] * $items['qty']) + ($saos['harga'] * $items['qty']);
                } else {
                    $subtotal = $items['price'] * $items['qty'];
                }
                $total += $subtotal;
                if (!$saos) {
                    $output .= '
                    </div>
                    </li>
                    </ul>';
                } else {
                    $output .= '<div class="variant-cart">Saos : ' . $saos['nama_varian'] . '
                    </div>
                    </div>
                    </li>
                    </ul>';
                }
            }
        }

        $output .= '
        <div class="total">
        <div class="total-in">
            <span class="label">Cart Subtotal:</span><span class="product-price"><span class="money">Rp. ' . number_format($total, 0, ".", ".") . '</span></span>
        </div>
        <div class="buttonSet text-center">
            <a href="' . base_url('cart/shopcart') . '" class="btn btn-secondary btn--small">View Cart</a>
            <a href="' . base_url('checkout') . '" class="btn btn-secondary btn--small">Checkout</a>
        </div>
    </div>
        ';

        return array(
            'item' => $output,
            'count' => $record,
        );
    }

    public function load_cart()
    {
        echo json_encode($this->show_cart());
    }

    public function add_cart()
    { //fungsi Add To Cart
        $id = $this->input->post('produk_id', TRUE);
        $varian = $this->input->post('saos');
        $produk = $this->db->get_where('tabel_produk', ['produk_id' => $id])->row_array();

        $data = array(
            'id' => $id,
            'name' => $produk['produk_nama'],
            'price' => $produk['harga'],
            'qty' => 1,
            'options' => array('varian_id' => $varian)
        );

        $this->cart->insert($data);

        echo json_encode($this->show_cart()); //tampilkan cart setelah added
    }

    function cekStock()
    {
        $stock = $this->db->get_where('tabel_produk', array('produk_id' => $this->input->post('produk_id')))->row_array();
        $varian = $this->db->get_where('tabel_kategori', array('kategori_id' => $stock['kategori_id']))->row_array();
        if ($stock['in_stock'] == 1) {
            $output = '1';
        } else {
            $output = '0';
        }

        if ($varian['varian'] == 1) {
            $saus = '1';
        } else {
            $saus = '0';
        }

        $data = array(
            'output' => $output,
            'saus' => $saus
        );
        echo json_encode($data);
    }

    function cekStockSaus()
    {
        $stock = $this->db->get_where('tabel_varian_saus', array('varian_id' => $this->input->post('saos')))->row_array();
        if ($stock['in_stock'] == 1) {
            $output = '1';
        } else {
            $output = '0';
        }

        $data = array(
            'output' => $output,
        );
        echo json_encode($data);
    }

    public function hapus_cart()
    { //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('detail_id'),
            'qty' => 0,
        );
        $this->cart->update($data);
        echo json_encode($this->show_cart());
    }

    public function contact_us()
    {
        $id_member = $this->session->userdata('id');
        $data['produk'] = $this->mod_home->getProduk();
        $data['newproduk'] = $this->mod_home->getNewProduk();
        $data['title'] = 'The Crabbys - Hubungi Kami';
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => 'Masukan nama anda!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Masukan email anda!',
            'valid_email' => 'Masukan email dengan benar!'
        ]);
        $this->form_validation->set_rules('hp', 'Nomor Handphone', 'required|is_natural', [
            'required' => 'Masukan nomor handphone anda!',
            'is_natural' => 'Masukan nomor handphone dengan benar!'
        ]);
        $this->form_validation->set_rules('subject', 'Subject', 'required', [
            'required' => 'Masukan subject pesan!'
        ]);
        $this->form_validation->set_rules('message', 'Kritik atau Saran', 'required', [
            'required' => 'Masukan pesan anda!'
        ]);

        if ($this->form_validation->run()) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pesan anda telah kami terima. Terima kasih atas kritik & saran anda.</div>');
            redirect('home/contact_us');
        } else {
            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/contact_us', $data);
            $this->load->view('layoutweb/footer');
        }
    }
}
