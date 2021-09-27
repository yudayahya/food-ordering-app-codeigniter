<?php
class Checkout extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda belum login! Silahkan login atau daftar terlebih dahulu.</div>');
            redirect('member');
        }
    }

    function index()
    {
        $id_member = $this->session->userdata('id');
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }
        $data['title'] = 'The Crabbys - Chechout';
        $data['user'] = $this->db->get_where('tabel_member', ['username' =>
        $this->session->userdata('username')])->row_array();
        $id_user = $this->session->userdata('id');
        $data['kupon'] = array();
        $kupon = $this->db->query("SELECT * FROM `tabel_kupon_user` WHERE `id_member`=0 OR `id_member`=$id_user")->result();
        foreach ($kupon as $k) {
            $data['kupon'][] = $this->db->get_where('tabel_kupon', array('id' => $k->id_kupon))->row_array();
        }

        if (!$this->cart->contents()) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Keranjang anda kosong! Silahkan masukan produk ke dalam keranjang terlebih dahulu.</div>');
            redirect('cart/shopcart');
        } else {
            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/checkout/body', $data);
            $this->load->view('layoutweb/footer');
        }
    }

    function validasi_produk()
    {
        //cek ketersediaan produk
        $listProduk = $this->cart->contents();
        $hasil = '0';
        foreach ($listProduk as $cek) {
            $produk = $this->db->get_where('tabel_produk', array('produk_id' => $cek['id']))->row_array();
            $saos = $this->db->get_where('tabel_varian_saus', array('varian_id' => $cek['options']['varian_id']))->row_array();
            if ($produk['in_stock'] == 0) {
                $data = array(
                    'rowid' => $cek['rowid'],
                    'qty' => 0,
                );
                $this->cart->update($data);
                $hasil = '1';
            }

            if ($saos) {
                if ($saos['in_stock'] == 0) {
                    $data = array(
                        'rowid' => $cek['rowid'],
                        'qty' => 0,
                    );
                    $this->cart->update($data);
                    $hasil = '1';
                }
            }
        }

        if ($hasil == '1') {
            $output = 'fail';
        } else {
            $output = 'sukses';
        }

        echo json_encode($output);
    }

    function proses_checkout()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('hp', 'Nomor Handphone', 'required');
        $this->form_validation->set_rules('inputongkir', 'Lokasi', 'required', [
            'required' => 'error maps'
        ]);
        $this->form_validation->set_rules('catatan', 'Catatan', 'required', [
            'required' => 'Berikan catatan untuk alamat yang lebih jelas agar memudahkan pengiriman.'
        ]);

        if ($this->form_validation->run()) {
            //dapatkan id member
            $id_kupon = $this->input->post('id_kupon');
            $member = $this->db->get_where('tabel_member', array('username' => $this->session->userdata('username')))->row_array();
            // if ($bayar == 1) {
            //     $transaksi = array(
            //         'member_id'     => $member['member_id'],
            //         'tanggal'       => date("Y-m-d"),
            //         'status'        => 1,
            //         'waktu'         => date("Y-m-d H:i:s"),
            //         'waktu_batas'   => date("Y-m-d H:i:s", strtotime("+2 hours")),
            //         'pembayaran'    => $bayar,
            //         'total'         => $this->input->post('total'),
            //         'kode_unik'     => random_string('numeric', 3),
            //         'ongkir'        => $this->input->post('inputongkir'),
            //         'for_event'     => 1
            //     );
            // } else {
            $transaksi = array(
                'member_id'     => $member['member_id'],
                'tanggal'       => date("Y-m-d"),
                'status'        => 1,
                'waktu'         => date("Y-m-d H:i:s"),
                'waktu_batas'   => date("Y-m-d H:i:s", strtotime("+20 minutes")),
                'pembayaran'    => $this->input->post('bayar'),
                'total'         => $this->input->post('total'),
                'id_kupon'      => $id_kupon,
                'potongan'      => $this->input->post('potongan'),
                'ongkir'        => $this->input->post('inputongkir'),
                'for_event'     => 1
            );


            //insert tabel transaksi
            $this->db->insert('tabel_transaksi', $transaksi);

            $lastTransaksi = $this->db->get_where('tabel_transaksi', $transaksi)->row_array();
            //dapatkan billing informasi
            $bill = array(
                'transaksi_id'     => $lastTransaksi['transaksi_id'],
                'nama_lengkap'     => $this->input->post('nama'),
                'email'            => $this->input->post('email'),
                'no_hp'            => $this->input->post('hp'),
                'catatan'          => $this->input->post('catatan'),
                'lat'              => $this->input->post('lat'),
                'lng'              => $this->input->post('lng')
            );

            //insert tabel transaksi
            $this->db->insert('tabel_transaksi_detail_billing', $bill);

            //loping data produk
            $listProduk = $this->cart->contents();
            foreach ($listProduk as $l) {
                $data = array(
                    'transaksi_id' => $lastTransaksi['transaksi_id'],
                    'produk_id' => $l['id'],
                    'varian_id' => $l['options']['varian_id'],
                    'qty' => $l['qty']
                );
                $this->db->insert('tabel_transaksi_detail', $data);
            }

            $this->cart->destroy();

            if ($id_kupon) {
                $dataKupon = array(
                    'id_kupon'      => $id_kupon,
                    'id_transaksi'  => $lastTransaksi['transaksi_id'],
                    'id_member'     => $member['member_id']
                );

                //insert tabel transaksi
                $this->db->insert('tabel_kupon_used', $dataKupon);
            }

            require_once(APPPATH . 'views/vendor/autoload.php');

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                '53605ae7340f790a342a',
                '41c002c7cd6bd744c3b8',
                '949402',
                $options
            );

            $data['id'] = $lastTransaksi['transaksi_id'];
            $pusher->trigger('adminNotif', 'dapur', $data);

            $array = array(
                'success' => 'sukses',
                'order_id' => $lastTransaksi['transaksi_id']
            );
        } else {
            $array = array(
                'error' => true,
                'error_nama' => form_error('nama', '<span class="text-danger pl-1">', '</span>'),
                'error_email' => form_error('email', '<span class="text-danger pl-1">', '</span>'),
                'error_hp' => form_error('hp', '<span class="text-danger pl-1">', '</span>'),
                'error_inputongkir' => form_error('inputongkir', '<span class="text-danger pl-1">', '</span>'),
                'error_catatan' => form_error('catatan', '<span class="text-danger pl-1">', '</span>')
            );
        }

        echo json_encode($array);
    }

    function cek_dapur()
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
            $cek = $this->db->get_where('tabel_transaksi', array('transaksi_id' => $this->uri->segment(3)))->row_array();
            if ($cek['status'] == 1) {
                $data['time'] = date('m/d/Y h:i:s a', time());
                $data['waktu'] = strtotime("+3 minutes", strtotime($cek['waktu']));
                $data['title'] = 'The Crabbys - Konfirmasi Dapur';
                $this->load->view('layoutweb/checkout/cek_dapur', $data);
            } else {
                $data['title'] = 'The Crabbys - 404 Page Not Found';
                $this->load->view('layoutweb/header', $data);
                $this->load->view('layoutweb/navigation', $data);
                $this->load->view('layoutweb/404', $data);
                $this->load->view('layoutweb/footer');
            }
        }
    }

    public function ubah_status()
    {
        $id = $this->input->post('id');
        $this->db->where('transaksi_id', $id);
        $this->db->update('tabel_transaksi', array('status' => 6));
    }

    public function orderTimeout()
    {
        $id = $this->input->post('id');

        $this->db->where('transaksi_id', $id);
        $this->db->delete('tabel_transaksi');

        require_once(APPPATH . 'views/vendor/autoload.php');

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '53605ae7340f790a342a',
            '41c002c7cd6bd744c3b8',
            '949402',
            $options
        );

        $data['pesan'] = 1;
        $pusher->trigger('adminNotif', 'orderTimeout', $data);
    }

    public function apply_voucher()
    {
        $kupon = $this->db->get_where('tabel_kupon', array('id' => $this->input->post('id')))->row_array();
        if ($kupon) {
            $last_date = strtotime($kupon['last_date']);
            if ($kupon['status'] == 1 && date('m/d/Y', time()) <= date('m/d/Y', $last_date)) {
                $output = $kupon;
            } else {
                $output = 'fail';
            }
        } else {
            $output = 'invalid';
        }
        echo json_encode($output);
    }
}
