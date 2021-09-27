<?php

class Member extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mod_member');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Member';
        $data['aktif'] = 'Member';
        $data['record'] = $this->mod_member->select_all();
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/member/data', $data);
    }

    public function ajax_list()
    {
        $list = $this->mod_member->select_all();
        $data = array();
        $no = 1;
        foreach ($list as $member) {
            $row = array();
            $row[] = $no;
            $row[] = $member->nama_lengkap;
            $row[] = $member->email;
            $row[] = '<img src="' . base_url() . 'assets/gambar_member/' . $member->gambar . '" style="width: 100%; max-width:100px; height: auto">';
            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Detail" onclick="detail_person(' . "'" . $member->member_id . "'" . ')"><i class="fa fa-fw fa-eye"></i> Detail</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $member->member_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function detail()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Member';
        $data['aktif'] = 'Member';
        $id = $this->uri->segment(4);
        if (!$id == null) {
            $data['row'] = $this->db->get_where('tabel_member', array('member_id' => $id))->row_array();
            $data['order'] = $this->db->get_where('tabel_transaksi', array('member_id' => $id))->result();
            $this->template->load('layoutadmin/templateadmin', 'layoutadmin/member/detail', $data);
        } else {
            $this->load->view('layoutadmin/auth/blocked');
        }
    }

    function hapus()
    {
        $this->db->where('member_id', $this->input->post('hapus'));
        $this->db->delete('tabel_member');
        $array = array(
            'success' => '<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Notifikasi!</h4>
                        Member Berhasil Dihapus.
                        </div>'
        );

        echo json_encode($array);
    }
}
