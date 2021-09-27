<?php

class Payment extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-dxzPS4HHLc9a8mRVEuqBOE-t', 'production' => false);
        $this->load->library('veritrans');
        $this->veritrans->config($params);
        $this->load->helper('string');
        $this->load->helper('url');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda belum login! Silahkan login atau daftar terlebih dahulu.</div>');
            redirect('member');
        }
    }

    public function gateway()
    {
        if (!$this->uri->segment(3)) {
            $data['title'] = 'The Crabbys - 404 Page Not Found';
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
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/404', $data);
            $this->load->view('layoutweb/footer');
        } else {
            if ($this->input->get('result') == 'success') {
                redirect('payment/gateway/' . $this->input->get('order_id'));
            } else {
                $id = $this->uri->segment(3);
                $data['title'] = 'The Crabbys - Order ' . $id;
                $member = $this->session->userdata('id');
                $data['transaksi'] = $this->db->get_where('tabel_transaksi', array(
                    'transaksi_id' => $id,
                    'member_id' => $member
                ))->row_array();

                $query = "SELECT tb1.*,tb2.produk_nama,tb2.gambar,tb2.harga,tb2.produk_nama_seo
                FROM tabel_transaksi_detail as tb1, tabel_produk as tb2 
                WHERE tb1.produk_id=tb2.produk_id and tb1.transaksi_id=$id
                order by tb1.detail_id";
                $data['detail'] = $this->db->query($query)->result();

                if (!$data['transaksi']) {
                    $data['title'] = 'The Crabbys - 404 Page Not Found';
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
                    $data['time'] = date('m/d/Y h:i:s a', time());
                    $data['response'] = $this->veritrans->status($id);

                    $this->load->view('layoutweb/header', $data);
                    $this->load->view('layoutweb/navigation', $data);
                    $this->load->view('layoutweb/payment/gateway', $data);
                    $this->load->view('layoutweb/footer');
                }
            }
        }
    }

    // public function transfer()
    // {
    //     if (!$this->uri->segment(3)) {
    //         $data['title'] = 'The Crabbys - 404 Page Not Found';
    //         $this->load->view('layoutweb/header', $data);
    //         $this->load->view('layoutweb/navigation', $data);
    //         $this->load->view('layoutweb/404', $data);
    //         $this->load->view('layoutweb/footer');
    //     } else {
    //         $data['title'] = 'The Crabbys - Transfer Bank';
    //         $id = $this->uri->segment(3);
    //         $member = $this->session->userdata('id');
    //         $data['transaksi'] = $this->db->get_where('tabel_transaksi', array(
    //             'transaksi_id' => $id,
    //             'member_id' => $member
    //         ))->row_array();

    //         $query = "SELECT tb1.*,tb2.produk_nama,tb2.gambar,tb2.harga,tb2.produk_nama_seo
    //             FROM tabel_transaksi_detail as tb1, tabel_produk as tb2 
    //             WHERE tb1.produk_id=tb2.produk_id and tb1.transaksi_id=$id
    //             order by tb1.detail_id";
    //         $data['detail'] = $this->db->query($query)->result();

    //         if (!$data['transaksi']) {
    //             $data['title'] = 'The Crabbys - 404 Page Not Found';
    //             $this->load->view('layoutweb/header', $data);
    //             $this->load->view('layoutweb/navigation', $data);
    //             $this->load->view('layoutweb/404', $data);
    //             $this->load->view('layoutweb/footer');
    //         } else {
    //             $data['time'] = date('m/d/Y h:i:s a', time());

    //             $this->load->view('layoutweb/header', $data);
    //             $this->load->view('layoutweb/navigation', $data);
    //             $this->load->view('layoutweb/payment/bank', $data);
    //             $this->load->view('layoutweb/footer');
    //         }
    //     }
    // }

    // function transfer_bukti()
    // {
    //     $id = $this->input->post('id');

    //     $config['upload_path'] = "./assets/gambar_bukti";
    //     $config['allowed_types'] = 'jpeg|jpg|png';
    //     $config['encrypt_name'] = TRUE;
    //     $this->load->library('upload', $config);
    //     $this->upload->do_upload("gambar");
    //     $data = array('upload_data' => $this->upload->data());
    //     $image = $data['upload_data']['file_name'];

    //     $bukti = array(
    //         'transaksi_id'  => $id,
    //         'nama'          => $this->input->post('nama'),
    //         'rekening'      => $this->input->post('nomor'),
    //         'bank'          => $this->input->post('bank'),
    //         'gambar'        => $image
    //     );

    //     $cekbukti = $this->db->get_where('tabel_transaksi_bukti', array('transaksi_id' => $id))->row_array();
    //     if (!$cekbukti) {
    //         $this->db->insert('tabel_transaksi_bukti', $bukti);
    //     } else {
    //         unlink(FCPATH . 'assets/gambar_bukti/' . $cekbukti['gambar']);

    //         $this->db->where('transaksi_id', $id);
    //         $this->db->update('tabel_transaksi_bukti', $bukti);
    //     }

    //     $lastbukti = $this->db->get_where('tabel_transaksi_bukti', $bukti)->row_array();

    //     $this->db->where('transaksi_id', $id);
    //     $this->db->update('tabel_transaksi', array(
    //         'id_bukti' => $lastbukti['id'],
    //         'status' => 4,
    //         'for_event' => 0,
    //     ));

    //     //pusher
    //     require_once(APPPATH . 'views/vendor/autoload.php');

    //     $options = array(
    //         'cluster' => 'ap1',
    //         'useTLS' => true
    //     );
    //     $pusher = new Pusher\Pusher(
    //         '53605ae7340f790a342a',
    //         '41c002c7cd6bd744c3b8',
    //         '949402',
    //         $options
    //     );

    //     $data['message'] = 'hello world';
    //     $pusher->trigger('my-channel', 'my-event', $data);
    //     //end pusher

    //     redirect('payment/transfer/' . $id);
    // }
}
