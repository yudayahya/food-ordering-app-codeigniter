<?php

class Unknown extends CI_Controller
{
    function index()
    {
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
    }
}
