<?php

class Livechat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_member', 'member');
        $this->load->model('mod_chat', 'chat');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Anda belum login! Silahkan login atau daftar terlebih dahulu.</div>');
            redirect('member');
        }
    }

    public function index()
    {
        $data['title'] = 'The Crabbys - Live Chat';
        $data['user'] = $this->db->get_where('tabel_member', ['username' =>
        $this->session->userdata('username')])->row_array();
        $list = $this->db->get_where('tabel_transaksi', array(
            'member_id' => $this->session->userdata('id'),
            'status <' => 5
        ))->result();
        $data['list'] = count($list);
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
        $this->load->view('layoutweb/member/livechat', $data);
        $this->load->view('layoutweb/footer');
    }

    function load_chat_body()
    {
        $id_member = $this->session->userdata('id');

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
        $pusher->trigger('chat-channel', 'chat-read-member', $pusherdata);

        $this->chat_body();
    }

    function pusher_load_chat_body()
    {
        $this->chat_body();
    }

    function chat_body()
    {
        $id_member = $this->session->userdata('id');
        $id_admin = '1';
        $list = $this->chat->chat_list($id_member)->result_array();
        $this->chat->chat_read_member($id_member);
        $data = '';
        if ($list) {
            foreach ($list as $chat) {
                if ($chat['status'] == 0) {
                    $status = 'text-muted';
                } else {
                    $status = 'text-primary';
                }
                if ($chat['msg_type'] == 0) {
                    if ($chat['pengirim_msg_id'] == $id_member) {
                        $data .= '<div class="media w-50 ml-auto mb-3">
                                <div class="media-body">
                                <div class="bg-primary rounded py-2 px-3 mb-2">
                                    <p class="text-small mb-0 text-white">' . $chat['message'] . '</p>
                                </div>
                                <div>
                                    <span class="' . $status . '"><i class="fa fa-check"></i></span>
                                    <span class="small text-muted"> ' . $chat['msg_timestamp'] . '</span>
                                </div>
                                </div>
                                </div>';
                    } else {
                        $admin = $this->db->get_where('tabel_admin', array('id' => $chat['pengirim_msg_id']))->row_array();
                        $data .= '<div class="media w-50 mb-3"><img src="' . base_url() . 'assets/gambar_admin/' . $admin['image'] . '" alt="user" width="50" class="rounded-circle user-picture">
                                <div class="media-body ml-3">
                                    <div class="bg-light rounded py-2 px-3 mb-2">
                                        <p class="text-small mb-0 text-muted">' . $chat['message'] . '</p>
                                    </div>
                                    <div>
                                        <span class="small text-muted"> ' . $chat['msg_timestamp'] . '</span>
                                    </div>
                                </div>
                                </div>';
                        $id_admin = $chat['pengirim_msg_id'];
                    }
                } else {
                    if ($chat['pengirim_msg_id'] == $id_member) {
                        $data .= '<div class="media w-50 ml-auto mb-3">
                        <div class="media-body">
                        <div class="bg-primary rounded py-2 px-3 mb-2">
                        <a href="' . base_url() . 'assets/gambar_chatting/' . $chat['message'] . '" target="_blank" data-title="">
                        <img src="' . base_url() . 'assets/gambar_chatting/' . $chat['message'] . '" style="width: 100%; max-width:100px; height: auto">
                        </a>
                        </div>
                        <div>
                            <span class="' . $status . '"><i class="fa fa-check"></i></span>
                            <span class="small text-muted"> ' . $chat['msg_timestamp'] . '</span>
                        </div>
                        </div>
                        </div>';
                    } else {
                        $admin = $this->db->get_where('tabel_admin', array('id' => $chat['pengirim_msg_id']))->row_array();
                        $data .= '<div class="media w-50 mb-3"><img src="' . base_url() . 'assets/gambar_admin/' . $admin['image'] . '" alt="user" class="rounded-circle user-picture">
                        <div class="media-body ml-3">
                            <div class="bg-light rounded py-2 px-3 mb-2">
                            <a href="' . base_url() . 'assets/gambar_chatting/' . $chat['message'] . '" target="_blank" data-title="">
                            <img src="' . base_url() . 'assets/gambar_chatting/' . $chat['message'] . '" style="width: 100%; max-width:100px; height: auto">
                            </a>
                            </div>
                            <div>
                                <span class="small text-muted"> ' . $chat['msg_timestamp'] . '</span>
                            </div>
                        </div>
                        </div>';
                        $id_admin = $chat['pengirim_msg_id'];
                    }
                }
            }
        } else {
            $data .= '<h3 class="text-center">Tidak ada riwayat percakapan.</h3>';
        }

        $data .= '<input type="hidden" name="id_member" id="id_member" value="' . $id_member . '">
        <input type="hidden" name="id_admin" id="id_admin" value="' . $id_admin . '">';

        $output = array(
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
            $this->chat->simpan_text($datetime, $id_member, $id_admin, $message, $type, $status);

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
}
