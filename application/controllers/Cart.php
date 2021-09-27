<?php

class Cart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function shopcart()
    {
        $data['title'] = 'The Crabbys - Shopping Cart';
        $id_member = $this->session->userdata('id');
        $data['newmessage'] = '';
        if ($id_member) {
            $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`='0'";
            $chat = $this->db->query($sql)->result();
            if ($chat) {
                $data['newmessage'] = 'ada';
            }
        }

        $list = $this->cart->contents();
        foreach ($list as $l) {
            $this->form_validation->set_rules('quantity' . $l['rowid'], 'Quantity', 'required|is_natural');
        }
        if ($this->form_validation->run()) {
            $this->update_stok();
        } else {
            $this->load->view('layoutweb/header', $data);
            $this->load->view('layoutweb/navigation', $data);
            $this->load->view('layoutweb/cart/body', $data);
            $this->load->view('layoutweb/footer');
        }
    }

    function hapus_item($id)
    {
        $data = array(
            'rowid' => $id,
            'qty' => 0,
        );
        $this->cart->update($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Notifikasi. Keranjang anda telah diubah.</div>');
        redirect('cart/shopcart');
    }

    function update_stok()
    {
        $list = $this->cart->contents();
        foreach ($list as $l) {
            $data = array(
                'rowid' => $this->input->post('id' . $l['rowid']),
                'qty' => $this->input->post('quantity' . $l['rowid']),
            );
            $this->cart->update($data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Notifikasi. Keranjang anda telah diubah.</div>');
        redirect('cart/shopcart');
    }
}
