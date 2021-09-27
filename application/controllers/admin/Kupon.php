<?php

class Kupon extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->model('mod_kupon');
        $this->load->model('mod_member');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Kupon';
        $data['aktif'] = 'Kupon';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/kupon/data', $data);
    }

    public function ajax_list()
    {
        $list = $this->mod_kupon->kupon_list();
        $data = array();
        $no = 1;
        foreach ($list as $kupon) {
            if ($kupon->kupon_type == 1) {
                $diskon = $kupon->diskon . '%';
            } else {
                $diskon = 'Rp. ' . number_format($kupon->diskon, 0, ".", ".");
            }
            if ($kupon->status == 1) {
                $status = '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-info" disabled>AKTIF</button>
                <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="javascript:void(0)" onclick="changestatus(' . "'" . $kupon->id . "'" . ',' . "'" . $kupon->status . "'" . ')">NONAKTIF</a></li>
                </ul>
              </div>';
            } else {
                $status = '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-danger" disabled>NONAKTIF</button>
                <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="javascript:void(0)" onclick="changestatus(' . "'" . $kupon->id . "'" . ',' . "'" . $kupon->status . "'" . ')">AKTIF</a></li>
                </ul>
              </div>';
            }
            $row = array();
            $row[] = $no;
            $row[] = $kupon->kupon_nama;
            $row[] = $kupon->valid_per_member;
            $row[] = $kupon->last_date;
            $row[] = $diskon;
            $row[] = 'Rp. ' . number_format($kupon->minimum_spend, 0, ".", ".");
            $row[] = 'Rp. ' . number_format($kupon->maksimal_diskon, 0, ".", ".");
            $row[] = '<a class="btn btn-sm btn-info" href="' . base_url('admin/kupon/setUser/') . $kupon->id . '" title="Atur Pengguna"><i class="fa fa-edit"></i> ATUR PENGGUNA</a>';
            $row[] = $status;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $kupon->id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getmember()
    {
        $member = $this->db->get_where('tabel_member')->result();
        echo json_encode($member);
    }

    public function simpan_kupon()
    {
        $this->form_validation->set_rules('namakupon', 'Nama Kupon', 'required', [
            'required' => 'Data Masih Kosong!',
        ]);
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|is_natural_no_zero', [
            'required' => 'Data Masih Kosong!',
            'is_natural_no_zero' => 'Gunakan Angka Lebih Dari 0!'
        ]);
        $this->form_validation->set_rules('minimum_spend', 'Minimal Pembelian', 'required|is_natural_no_zero', [
            'required' => 'Data Masih Kosong!',
            'is_natural_no_zero' => 'Gunakan Angka Lebih Dari 0!'
        ]);
        $this->form_validation->set_rules('maksimal_diskon', 'Maksimal Diskon', 'required|is_natural_no_zero', [
            'required' => 'Data Masih Kosong!',
            'is_natural_no_zero' => 'Gunakan Angka Lebih Dari 0!'
        ]);
        $this->form_validation->set_rules('NoOfUse', 'Jumlah Penggunaan per Member', 'required|is_natural_no_zero', [
            'required' => 'Data Masih Kosong!',
            'is_natural_no_zero' => 'Gunakan Angka Lebih Dari 0!'
        ]);
        $this->form_validation->set_rules('tgl', 'Tanggal Expired', 'required', [
            'required' => 'Data Masih Kosong!'
        ]);
        if ($this->form_validation->run()) {
            $kupon_nama = strtoupper($this->input->post('namakupon'));
            $valid_per_member = $this->input->post('NoOfUse');
            $last_date = date("Y-m-d", strtotime($this->input->post('tgl')));
            $diskon = $this->input->post('diskon');
            $minimum_spend = $this->input->post('minimum_spend');
            $maksimal_diskon = $this->input->post('maksimal_diskon');
            $kupon_type = $this->input->post('tipe');
            $status = 0;

            $this->mod_kupon->simpan($kupon_nama, $valid_per_member, $last_date, $diskon, $minimum_spend, $maksimal_diskon, $kupon_type, $status);
            $array = array(
                'success' => '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                            Data Berhasil Dimasukan.
                            </div>'
            );
        } else {
            $array = array(
                'error' => true,
                'error_namakupon' => form_error('namakupon'),
                'error_diskon' => form_error('diskon'),
                'error_NoOfUse' => form_error('NoOfUse'),
                'error_tglexpired' => form_error('tgl'),
                'error_minimum_spend' => form_error('minimum_spend'),
                'error_maksimal_diskon' => form_error('maksimal_diskon')
            );
        }

        echo json_encode($array);
    }

    function changestatus()
    {
        $status = $this->input->post('status');
        if ($status == 1) {
            $newstatus = 0;
        } else {
            $newstatus = 1;
        }

        $this->mod_kupon->changestatus($newstatus);
        $array = array(
            'success' => '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                            Data Berhasil Diubah.
                            </div>'
        );

        echo json_encode($array);
    }

    public function hapus_kupon()
    {
        $this->mod_kupon->hapus($this->input->post('hapus'));
        $array = array(
            'success' => '<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Notifikasi!</h4>
                        Data Berhasil Dihapus.
                        </div>'
        );

        echo json_encode($array);
    }

    public function setUser()
    {
        $data['title'] = 'Atur Pengguna Kupon';
        $id = $this->uri->segment(4);
        if ($id != null) {
            $kupon = $this->db->get_where('tabel_kupon', array('id' => $id))->row_array();
            if ($kupon) {
                $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
                $this->session->userdata('email')])->row_array();
                $data['title'] = 'Pengguna Kupon';
                $data['cek'] = $this->db->get_where('tabel_kupon_user', array('id_kupon' => $kupon['id'], 'id_member' => 0))->row_array();
                $data['aktif'] = 'Kupon';
                $this->template->load('layoutadmin/templateadmin', 'layoutadmin/kupon/setUser', $data);
            } else {
                $this->load->view('layoutadmin/auth/blocked');
            }
        } else {
            $this->load->view('layoutadmin/auth/blocked');
        }
    }

    public function list_user_kupon()
    {
        $id = $this->input->post('id');
        $list = $this->mod_kupon->user_kupon($id);
        $data = array();
        $no = 1;
        foreach ($list as $kupon) {
            $member = $this->db->get_where('tabel_member', array('member_id' => $kupon->id_member))->row_array();
            $row = array();
            $row[] = $no;
            $row[] = $member['nama_lengkap'];
            $row[] = $member['email'];
            //add html for action
            $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="remove_user(' . "'" . $kupon->id . "'" . ')"><i class="fa fa-minus"></i></a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function list_member()
    {
        $id = $this->input->post('id');
        $list = $this->mod_kupon->list_member($id);
        $data = array();
        $no = 1;
        foreach ($list as $member) {
            $transaksi = count($this->db->get_where('tabel_transaksi', array('member_id' => $member->member_id, 'status' => 5))->result_array());
            $row = array();
            $row[] = $no;
            $row[] = $member->nama_lengkap;
            $row[] = $member->email;
            $row[] = $transaksi;
            //add html for action
            $row[] = '<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Add" onclick="add_user(' . "'" . $member->member_id . "'" . ')"><i class="fa fa-plus"></i></a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function remove_kupon_user()
    {
        $id = $this->input->post('id_kupon');
        $this->db->where('id', $id);
        $this->db->delete('tabel_kupon_user');
        $array = array(
            'success' => '<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Notifikasi!</h4>
                        Data Berhasil Dihapus.
                        </div>'
        );

        echo json_encode($array);
    }

    public function add_kupon_user()
    {
        $data = array(
            'id_kupon'              => $this->input->post('id_kupon'),
            'id_member'              => $this->input->post('id_member')
        );
        $this->db->insert('tabel_kupon_user', $data);
        $array = array(
            'success' => '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                        Data Berhasil Ditambahkan.
                        </div>'
        );
        echo json_encode($array);
    }

    public function kupon_allmember()
    {
        $id = $this->input->post('id_kupon');
        $this->db->where('id_kupon', $id);
        $this->db->delete('tabel_kupon_user');

        $data = array(
            'id_kupon'              => $id,
            'id_member'              => 0
        );
        $this->db->insert('tabel_kupon_user', $data);
        $array = array(
            'success' => '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                        Data Berhasil Ditambahkan.
                        </div>'
        );
        echo json_encode($array);
    }

    public function kupon_custommember()
    {
        $id = $this->input->post('id_kupon');
        $this->db->where('id_kupon', $id);
        $this->db->delete('tabel_kupon_user');
        $array = array(
            'success' => '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                        Data Berhasil Ditambahkan.
                        </div>'
        );
        echo json_encode($array);
    }
}
