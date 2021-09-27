<?php

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mod_home');
    }

    function detail()
    {
        if (!$this->uri->segment(3)) {
            $id_member = $this->session->userdata('id');
            $data['newmessage'] = '';
            if ($id_member) {
                $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
                $chat = $this->db->query($sql)->result();
                if ($chat) {
                    $data['newmessage'] = 'ada';
                }
            }
            $data['title'] = 'The Crabbys - 404 Page Not Found';
            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/404', $data);
            $this->load->view('layoutweb/footer');
        } else {
            $id_member = $this->session->userdata('id');
            $data['newmessage'] = '';
            if ($id_member) {
                $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
                $chat = $this->db->query($sql)->result();
                if ($chat) {
                    $data['newmessage'] = 'ada';
                }
            }
            $data['produk'] = $this->db->get_where('tabel_produk', array('produk_nama_seo' => $this->uri->segment(3)))->row_array();
            $data['produklain'] = $this->db->get_where('tabel_produk', array('kategori_id' => $data['produk']['kategori_id']))->result_array();
            if (!$data['produk']) {
                $data['title'] = 'The Crabbys - 404 Page Not Found';
                $this->load->view('layoutweb/header', $data);
                $this->load->view('layoutweb/navigation', $data);
                $this->load->view('layoutweb/404', $data);
                $this->load->view('layoutweb/footer');
            } else {
                $data['title'] = 'The Crabbys - Detail Produk';

                $this->load->view('layoutweb/header', $data);
                $this->load->view('layoutweb/navigation', $data);
                $this->load->view('layoutweb/detail/body', $data);
                $this->load->view('layoutweb/footer');
            }
        }
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

    public function add_produk()
    {
        $id = $this->input->post('produk_id');
        $qty = $this->input->post('quantity');
        $varian = $this->input->post('saos');
        $produk = $this->db->get_where('tabel_produk', ['produk_id' => $id])->row_array();

        $data = array(
            'id' => $id,
            'name' => $produk['produk_nama'],
            'price' => $produk['harga'],
            'qty' => $qty,
            'options' => array('varian_id' => $varian)
        );

        $this->cart->insert($data);

        echo json_encode($this->show_cart()); //tampilkan cart setelah added
    }
}
