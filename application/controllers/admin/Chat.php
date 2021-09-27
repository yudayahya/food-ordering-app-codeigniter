<?php

class Chat extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_chat', 'chat');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Live Chat';
        $data['aktif'] = 'Live Chat';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/chat/view_chat', $data);
    }

    function load_member_list()
    {
        $last_chat = $this->chat->last_chat()->result_array();
        $list_member = $this->chat->list_member()->result_array();
        $data = '';
        if ($last_chat) {
            foreach ($last_chat as $list) {
                $member = $this->db->get_where('tabel_member', array('email' => $list['emailmember']))->row_array();
                $msg = $this->db->get_where('tabel_message', array('msg_id' => $list['id_message']))->row_array();
                if ($msg['status'] == 0) {
                    $status = 'text-muted';
                } else {
                    $status = 'text-green';
                }
                if ($msg['pengirim_msg_id'] !== $member['member_id']) {
                    $display = '<span class="' . $status . '"><i class="fa fa-check"></i></span>';
                    $read = '';
                } else {
                    if ($msg['status'] == 0) {
                        $read = '<small class="contacts-list-date pull-right"><span class="label label-danger">new message</span></small>';
                    } else {
                        $read = '';
                    }
                    $display = '';
                }
                if ($msg['msg_type'] == 1) {
                    $message = 'Photo <i class="fa fa-camera"></i>';
                } else {
                    $message = $msg['message'];
                }
                $data .= '<li id="member' . $member['member_id'] . '">
                        <a href="#' . $member['member_id'] . '" onclick="view_chat(' . "'" . $member['member_id'] . "'" . ')">
                            <img class="contacts-list-img user-picture" src="' . base_url() . 'assets/gambar_member/' . $member['gambar'] . '" alt="User Image">
    
                            <div class="contacts-list-info">
                                <span class="contacts-list-name" style="color: black;">
                                ' . $member['nama_lengkap'] . ' ' . $read . '
                                </span>
                                <span class="contacts-list-msg">' . $display . ' ' . $message . '</span>
                            </div>
                            <!-- /.contacts-list-info -->
                        </a>
                        </li>';
            }
        }

        if ($list_member) {
            foreach ($list_member as $m) {
                $data .= '<li id="member' . $m['member_id'] . '">
            <a href="#' . $m['member_id'] . '" onclick="view_chat(' . "'" . $m['member_id'] . "'" . ')">
                <img class="contacts-list-img user-picture" src="' . base_url() . 'assets/gambar_member/' . $m['gambar'] . '" alt="User Image">

                <div class="contacts-list-info">
                    <span class="contacts-list-name" style="color: black;">
                    ' . $m['nama_lengkap'] . '
                    </span>
                    <span class="contacts-list-msg text-red"><strong>Tidak ada riwayat pesan!</strong></span>
                </div>
                <!-- /.contacts-list-info -->
            </a>
            </li>';
            }
        }

        $output = array(
            "item" => $data,
        );

        //output to json format
        echo json_encode($output);
    }

    function load_chat_body()
    {
        $id_member = $this->input->post('id_member');
        //pusher
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

        $pusherdata['id_member'] = $id_member;
        $pusher->trigger('chat-channel', 'chat-read-admin', $pusherdata);

        $this->chat_body();
    }

    function pusher_load_chat_body()
    {
        $this->chat_body();
    }

    function chat_body()
    {
        $id_member = $this->input->post('id_member');
        $list = $this->chat->chat_list($id_member)->result_array();
        $member = $this->chat->select_member($id_member)->row_array();
        $this->chat->chat_read_admin($id_member);
        $id_admin = $this->db->get_where('tabel_admin', array('email' => $this->session->userdata('email')))->row_array();
        $data = '';
        $endchat = '';
        if ($list) {
            foreach ($list as $chat) {
                if ($chat['status'] == 0) {
                    $status = 'text-muted';
                } else {
                    $status = 'text-green';
                }
                if ($chat['msg_type'] == 0) {
                    if ($chat['pengirim_msg_id'] == $id_member) {
                        $data .= '<div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">' . $member['nama_lengkap'] . ' <span class="direct-chat-timestamp">(' . $chat['msg_timestamp'] . ')</span></span>
                                </div>
                                <img class="direct-chat-img user-picture" src="' . base_url() . 'assets/gambar_member/' . $member['gambar'] . '" alt="message user image">
                                <div class="direct-chat-text pull-left">
                                    ' . $chat['message'] . '
                                </div>
                                </div>';
                    } else {
                        $admin = $this->db->get_where('tabel_admin', array('id' => $chat['pengirim_msg_id']))->row_array();
                        $data .= '<div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right"><span class="direct-chat-timestamp">(' . $chat['msg_timestamp'] . ')</span> ' . $admin['nama'] . '</span>
                                </div>
                                <img class="direct-chat-img user-picture" src="' . base_url() . 'assets/gambar_admin/' . $admin['image'] . '" alt="message user image">
                                <div class="direct-chat-text pull-right">
                                    ' . $chat['message'] . '
                                </div>
                                <span class="pull-right ' . $status . '"><i class="fa fa-check"></i></span>
                                </div>';
                    }
                } else {
                    if ($chat['pengirim_msg_id'] == $id_member) {
                        $data .= '<div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-left">' . $member['nama_lengkap'] . ' <span class="direct-chat-timestamp">(' . $chat['msg_timestamp'] . ')</span></span>
                                </div>
                                <img class="direct-chat-img user-picture" src="' . base_url() . 'assets/gambar_member/' . $member['gambar'] . '" alt="message user image">
                                <div class="direct-chat-text pull-left">
                                <a href="' . base_url() . 'assets/gambar_chatting/' . $chat['message'] . '" data-toggle="lightbox" data-title="">
                                <img src="' . base_url() . 'assets/gambar_chatting/' . $chat['message'] . '" style="width: 100%; max-width:100px; height: auto">
                                </a>
                                </div>
                                </div>';
                    } else {
                        $admin = $this->db->get_where('tabel_admin', array('id' => $chat['pengirim_msg_id']))->row_array();
                        $data .= '<div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                    <span class="direct-chat-name pull-right"><span class="direct-chat-timestamp">(' . $chat['msg_timestamp'] . ')</span> ' . $admin['nama'] . '</span>
                                </div>
                                <img class="direct-chat-img user-picture" src="' . base_url() . 'assets/gambar_admin/' . $admin['image'] . '" alt="message user image">
                                <div class="direct-chat-text pull-right">
                                <a href="' . base_url() . 'assets/gambar_chatting/' . $chat['message'] . '" data-toggle="lightbox" data-title="">
                                <img src="' . base_url() . 'assets/gambar_chatting/' . $chat['message'] . '" style="width: 100%; max-width:100px; height: auto">
                                </a>
                                </div>
                                <span class="pull-right ' . $status . '"><i class="fa fa-check"></i></span>
                                </div>';
                    }
                }
            }
            $endchat = '<a href="javascript:void(0)" onclick="end_chat(' . $id_member . ')" class="contacts-list-date pull-right"><span class="label label-danger"><i class="glyphicon glyphicon-trash"></i> End Chat</span></a>';
        }

        $data_member = '<img class="contacts-list-img user-picture" src="' . base_url() . 'assets/gambar_member/' . $member['gambar'] . '" alt="User Image">
        <div class="contacts-list-info">
            <span class="contacts-list-name" style="color: black;">
            ' . $member['nama_lengkap'] . '
            ' . $endchat . '
            </span>
            <span class="contacts-list-msg">';

        if ($member['status'] == 1) {
            $data_member .= '<i class="fa fa-circle-o text-green"> online</i></span>
            </div>';
        } else {
            $data_member .= '<i class="fa fa-circle-o"> offline</i></span>
            </div>';
        }

        $data .= '<input type="hidden" name="id_member" id="id_member" value="' . $id_member . '">
        <input type="hidden" name="id_admin" id="id_admin" value="' . $id_admin['id'] . '">';

        $output = array(
            "member" => $data_member,
            "item" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    function chat_insert()
    {
        $type = $this->input->post('type');
        $id_member = $this->input->post('id_member');
        $id_admin = $this->input->post('id_admin');
        $datetime = date("Y-m-d H:i:s");
        $status = 0;
        $error = 'false';
        if ($type == 1) {
            $config['upload_path'] = "./assets/gambar_chatting";
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']     = '1000';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload("file_input")) {
                $data = array('upload_data' => $this->upload->data());
                $message = $data['upload_data']['file_name'];
            } else {
                $error = 'true';
            }
        } else {
            $message = $this->input->post('message');
        }
        if ($error !== 'true') {
            $this->chat->simpan_text($datetime, $id_admin, $id_member, $message, $type, $status);

            //pusher
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

            $pusherdata['id_member'] = $id_member;
            $pusher->trigger('chat-channel', 'chat-send', $pusherdata);
        }
        $output = array(
            "member" => $id_member,
            "error"  => $error
        );
        echo json_encode($output);
    }

    function end_chat()
    {
        $id_member = $this->input->post('id_member');
        $this->chat->chat_delete($id_member);

        $output = array(
            "member" => $id_member
        );
        echo json_encode($output);
    }
}
