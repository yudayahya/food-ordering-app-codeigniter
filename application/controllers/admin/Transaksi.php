<?php

class Transaksi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('mod_transaksi');
        is_logged_in_admin();
    }

    function index()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Transaksi Konfirmasi Dapur';
        $data['aktif'] = 'Konfirmasi Dapur';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/transaksi/confirm', $data);
    }

    function pending()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Transaksi Pending';
        $data['aktif'] = 'Pending Bayar';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/transaksi/pending', $data);
    }

    function memasak()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Transaksi Memasak';
        $data['aktif'] = 'Memasak';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/transaksi/memasak', $data);
    }

    function mengirim()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Transaksi Mengirim';
        $data['aktif'] = 'Mengirim';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/transaksi/mengirim', $data);
    }

    function done()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Transaksi Selesai';
        $data['aktif'] = 'Selesai';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/transaksi/done', $data);
    }

    function laporan()
    {
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['title'] = 'Laporan Transaksi';
        $data['aktif'] = 'Selesai';
        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/transaksi/laporan', $data);
    }

    public function list_confirm()
    {
        $list = $this->mod_transaksi->select_confirm();
        $data = array();
        $no = 1;
        foreach ($list->result() as $t) {
            $status = 'KONFIRMASI DAPUR';
            $waktu = date("d F Y H:i:s", strtotime($t->waktu));
            $waktu_batas = date("d F Y H:i:s", strtotime($t->waktu_batas));
            $row = array();
            $row[] = $no;
            $row[] = $t->nama_lengkap;
            $row[] = $t->transaksi_id;
            $row[] = $waktu;
            $row[] = $waktu_batas;
            $row[] = $status;
            $row[] = strtoupper($t->pembayaran);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('admin/transaksi/detail/') . $t->transaksi_id . '" title="Detail"><i class="fa fa-eye"></i> Detail</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function list_pending()
    {
        $list = $this->mod_transaksi->select_pending();
        $data = array();
        $no = 1;
        foreach ($list->result() as $t) {
            $status = 'MENUNGGU PEMBAYARAN';
            $waktu = date("d F Y H:i:s", strtotime($t->waktu));
            $waktu_batas = date("d F Y H:i:s", strtotime($t->waktu_batas));
            $row = array();
            $row[] = $no;
            $row[] = $t->nama_lengkap;
            $row[] = $t->transaksi_id;
            $row[] = $waktu;
            $row[] = $waktu_batas;
            $row[] = $status;
            $row[] = strtoupper($t->pembayaran);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('admin/transaksi/detail/') . $t->transaksi_id . '" title="Detail"><i class="fa fa-eye"></i> Detail</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function list_memasak()
    {
        $list = $this->mod_transaksi->select_memasak();
        $data = array();
        $no = 1;
        foreach ($list->result() as $t) {
            $status = 'MEMASAK';
            $waktu = date("d F Y H:i:s", strtotime($t->waktu));
            $waktu_batas = date("d F Y H:i:s", strtotime($t->waktu_batas));
            $row = array();
            $row[] = $no;
            $row[] = $t->nama_lengkap;
            $row[] = $t->transaksi_id;
            $row[] = $waktu;
            $row[] = $waktu_batas;
            $row[] = $status;
            $row[] = strtoupper($t->pembayaran);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('admin/transaksi/detail/') . $t->transaksi_id . '" title="Detail"><i class="fa fa-eye"></i> Detail</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function list_mengirim()
    {
        $list = $this->mod_transaksi->select_mengirim();
        $data = array();
        $no = 1;
        foreach ($list->result() as $t) {
            $status = 'MENGIRIM';
            $waktu = date("d F Y H:i:s", strtotime($t->waktu));
            $waktu_batas = date("d F Y H:i:s", strtotime($t->waktu_batas));
            $row = array();
            $row[] = $no;
            $row[] = $t->nama_lengkap;
            $row[] = $t->transaksi_id;
            $row[] = $waktu;
            $row[] = $waktu_batas;
            $row[] = $status;
            $row[] = strtoupper($t->pembayaran);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('admin/transaksi/detail/') . $t->transaksi_id . '" title="Detail"><i class="fa fa-eye"></i> Detail</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function list_done()
    {
        $list = $this->mod_transaksi->select_done();
        $data = array();
        $no = 1;
        foreach ($list->result() as $t) {
            $status = 'TRANSAKSI SELESAI';
            $waktu = date("d F Y H:i:s", strtotime($t->waktu));
            $waktu_batas = date("d F Y H:i:s", strtotime($t->waktu_batas));
            $row = array();
            $row[] = $no;
            $row[] = $t->nama_lengkap;
            $row[] = $t->transaksi_id;
            $row[] = $waktu;
            $row[] = $waktu_batas;
            $row[] = $status;
            $row[] = strtoupper($t->pembayaran);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('admin/transaksi/detail/') . $t->transaksi_id . '" title="Detail"><i class="fa fa-eye"></i> Detail</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function sortDoneDate()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');

        $list = $this->mod_transaksi->select_done_by_date($awal, $akhir);
        $data = array();
        $no = 1;
        foreach ($list->result() as $t) {
            $status = 'TRANSAKSI SELESAI';
            $waktu = date("d F Y H:i:s", strtotime($t->waktu));
            $waktu_batas = date("d F Y H:i:s", strtotime($t->waktu_batas));
            $row = array();
            $row[] = $no;
            $row[] = $t->nama_lengkap;
            $row[] = $t->transaksi_id;
            $row[] = $waktu;
            $row[] = $waktu_batas;
            $row[] = $status;
            $row[] = strtoupper($t->pembayaran);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('admin/transaksi/detail/') . $t->transaksi_id . '" title="Detail"><i class="fa fa-eye"></i> Detail</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    public function list_expired()
    {
        $list = $this->mod_transaksi->select_expired();
        $data = array();
        $no = 1;
        foreach ($list->result() as $t) {
            $status = 'TRANSAKSI EXPIRED';
            $waktu = date("d F Y H:i:s", strtotime($t->waktu));
            $waktu_batas = date("d F Y H:i:s", strtotime($t->waktu_batas));
            $row = array();
            $row[] = $no;
            $row[] = $t->nama_lengkap;
            $row[] = $t->transaksi_id;
            $row[] = $waktu;
            $row[] = $waktu_batas;
            $row[] = $status;
            $row[] = strtoupper($t->pembayaran);

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url('admin/transaksi/detail/') . $t->transaksi_id . '" title="Detail"><i class="fa fa-eye"></i> Detail</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' . "'" . $t->transaksi_id . "'" . ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function list_laporan()
    {
        $list = $this->mod_transaksi->select_done();
        $data = array();
        $total = 0;
        foreach ($list->result() as $t) {
            $subtotal = 0;
            $order = $this->db->get_where('tabel_transaksi_detail', ['transaksi_id' => $t->transaksi_id])->result_array();
            $member = $this->db->get_where('tabel_member', ['member_id' => $t->member_id])->row_array();
            foreach ($order as $o) {
                $produk = $this->db->get_where('tabel_produk', ['produk_id' => $o['produk_id']])->row_array();
                $varian = $this->db->get_where('tabel_varian_saus', ['varian_id' => $o['varian_id']])->row_array();
                if ($varian) {
                    $sub = ($o['qty'] * $produk['harga']) + ($o['qty'] * $varian['harga']);
                } else {
                    $sub = $o['qty'] * $produk['harga'];
                }

                $row = array();
                $row[] = $t->transaksi_id;
                $row[] = $t->tanggal;
                $row[] = $member['nama_lengkap'];
                $row[] = $produk['produk_nama'];
                $row[] = $varian['nama_varian'];
                if ($varian) {
                    $row[] = $produk['harga'] + $varian['harga'];
                } else {
                    $row[] = $produk['harga'];
                }
                $row[] = $o['qty'];
                $row[] = $sub;
                $data[] = $row;
                $subtotal += $sub;
            }
            $rowfooter = array();
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "<strong>Sub Total</strong>";
            $rowfooter[] = $subtotal;
            $data[] = $rowfooter;
            $rowfooter = array();
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "<strong>Ongkir</strong>";
            $rowfooter[] = $t->ongkir;
            if ($t->id_kupon) {
                $data[] = $rowfooter;
                $rowfooter = array();
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "<strong>Diskon</strong>";
                $rowfooter[] = "<strike>" . $t->potongan . "</strike>";
            }
            $data[] = $rowfooter;
            $rowfooter = array();
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "<strong>Total</strong>";
            $rowfooter[] = $t->total;
            $data[] = $rowfooter;
            $rowfooter = array();
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $data[] = $rowfooter;
            $total += $t->total;
        }
        $rowfooter = array();
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "Total Keseluruhan";
        $rowfooter[] = $total;
        $data[] = $rowfooter;

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function detail()
    {
        if (isset($_POST['submit'])) {
            $this->mod_transaksi->update();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
            Data Berhasil Disimpan.
            </div>');
            redirect('admin/transaksi/detail/' . $_POST['id']);
        } else {
            $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
            $this->session->userdata('email')])->row_array();
            $data['title'] = 'Detail Transaksi';
            $id = $this->uri->segment(4);
            if ($id != null) {
                $transaksi = $this->db->get_where('tabel_transaksi', array('transaksi_id' => $id))->row_array();
                if ($transaksi) {
                    if ($transaksi['status'] != 1) {
                        $data['row'] = $this->db->get_where('tabel_member', array('member_id' => $transaksi['member_id']))->row_array();
                        $sql = "SELECT tb1.*,tb2.produk_nama,tb2.harga FROM tabel_transaksi_detail as tb1, tabel_produk as tb2 WHERE tb1.produk_id=tb2.produk_id and tb1.transaksi_id=$id";
                        $data['order'] = $this->db->query($sql)->result();
                        $data['pesanan'] = $this->db->get_where('tabel_transaksi', array('transaksi_id' => $id))->row_array();
                        $data['billing'] = $this->db->get_where('tabel_transaksi_detail_billing', array('transaksi_id' => $id))->row_array();
                        if ($data['pesanan']['status'] == 1) {
                            $data['aktif'] = 'Konfirmasi Dapur';
                        } else if ($data['pesanan']['status'] == 2) {
                            $data['aktif'] = 'Pending Bayar';
                        } else if ($data['pesanan']['status'] == 3) {
                            $data['aktif'] = 'Memasak';
                        } else if ($data['pesanan']['status'] == 4) {
                            $data['aktif'] = 'Mengirim';
                        } else {
                            $data['aktif'] = 'Selesai';
                        }
                        $this->template->load('layoutadmin/templateadmin', 'layoutadmin/transaksi/detail', $data);
                    } else {
                        $cekorder = $this->db->get_where('tabel_transaksi', array('transaksi_id' => $id))->row_array();
                        $waktu = strtotime("+3 minutes", strtotime($cekorder['waktu']));
                        $waktuNow = date('m/d/Y h:i:s a', time());
                        $waktubatas = date('m/d/Y h:i:s a', $waktu);
                        if ($waktuNow < $waktubatas) {
                            $sql = "SELECT tb1.*,tb2.produk_nama,tb2.harga FROM tabel_transaksi_detail as tb1, tabel_produk as tb2 WHERE tb1.produk_id=tb2.produk_id and tb1.transaksi_id=$id";
                            $data['order'] = $this->db->query($sql)->result();
                            $data['pesanan'] = $this->db->get_where('tabel_transaksi', array('transaksi_id' => $id))->row_array();
                            $data['aktif'] = 'Konfirmasi Dapur';
                            $this->template->load('layoutadmin/templateadmin', 'layoutadmin/transaksi/cekdapur', $data);
                        } else {
                            $this->db->where('transaksi_id', $id);
                            $this->db->delete('tabel_transaksi');
                            redirect('admin/transaksi');
                        }
                    }
                } else {
                    $this->load->view('layoutadmin/auth/blocked');
                }
            } else {
                $this->load->view('layoutadmin/auth/blocked');
            }
        }
    }

    function hapus()
    {
        $id = $this->input->post('hapus');

        // $img = $this->db->get_where('tabel_transaksi_bukti', array('transaksi_id' => $id))->row_array();
        // if (!$img) {
        $this->db->where('transaksi_id', $id);
        $this->db->delete('tabel_transaksi');
        // } else {
        //     unlink(FCPATH . 'assets/gambar_bukti/' . $img['gambar']);
        //     $this->db->where('transaksi_id', $id);
        //     $this->db->delete('tabel_transaksi_bukti');

        //     $this->db->where('transaksi_id', $id);
        //     $this->db->delete('tabel_transaksi');

        //     $this->db->where('transaksi_id', $id);
        //     $this->db->delete('tabel_transaksi_detail');

        //     $this->db->where('transaksi_id', $id);
        //     $this->db->delete('tabel_transaksi_detail_billing');
        // }

        $array = array(
            'success' => '<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Notifikasi!</h4>
                        Data Berhasil Dihapus.
                        </div>'
        );

        echo json_encode($array);
    }

    function hapus_expired()
    {
        $this->mod_transaksi->delete_expired();
        $array = array(
            'success' => '<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i> Notifikasi!</h4>
                        Data Berhasil Dihapus.
                        </div>'
        );

        echo json_encode($array);
    }

    public function sortByDate()
    {
        $awal = $this->input->post('awal');
        $akhir = $this->input->post('akhir');

        $list = $this->mod_transaksi->select_done_by_date($awal, $akhir);
        $data = array();
        $total = 0;
        foreach ($list->result() as $t) {
            $subtotal = 0;
            $order = $this->db->get_where('tabel_transaksi_detail', ['transaksi_id' => $t->transaksi_id])->result_array();
            $member = $this->db->get_where('tabel_member', ['member_id' => $t->member_id])->row_array();
            foreach ($order as $o) {
                $produk = $this->db->get_where('tabel_produk', ['produk_id' => $o['produk_id']])->row_array();
                $varian = $this->db->get_where('tabel_varian_saus', ['varian_id' => $o['varian_id']])->row_array();
                if ($varian) {
                    $sub = ($o['qty'] * $produk['harga']) + ($o['qty'] * $varian['harga']);
                } else {
                    $sub = $o['qty'] * $produk['harga'];
                }

                $row = array();
                $row[] = $t->transaksi_id;
                $row[] = $t->tanggal;
                $row[] = $member['nama_lengkap'];
                $row[] = $produk['produk_nama'];
                $row[] = $varian['nama_varian'];
                if ($varian) {
                    $row[] = $produk['harga'] + $varian['harga'];
                } else {
                    $row[] = $produk['harga'];
                }
                $row[] = $o['qty'];
                $row[] = $sub;
                $data[] = $row;
                $subtotal += $sub;
            }
            $rowfooter = array();
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "<strong>Sub Total</strong>";
            $rowfooter[] = $subtotal;
            $data[] = $rowfooter;
            $rowfooter = array();
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "<strong>Ongkir</strong>";
            $rowfooter[] = $t->ongkir;
            if ($t->id_kupon) {
                $data[] = $rowfooter;
                $rowfooter = array();
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "";
                $rowfooter[] = "<strong>Diskon</strong>";
                $rowfooter[] = "<strike>" . $t->potongan . "</strike>";
            }
            $data[] = $rowfooter;
            $rowfooter = array();
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "<strong>Total</strong>";
            $rowfooter[] = $t->total;
            $data[] = $rowfooter;
            $rowfooter = array();
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $rowfooter[] = "";
            $data[] = $rowfooter;
            $total += $t->total;
        }
        $rowfooter = array();
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "Total Keseluruhan";
        $rowfooter[] = $total;
        $data[] = $rowfooter;
        $rowfooter = array();
        $rowfooter[] = "<strong>LABA KOTOR.</strong>";
        $rowfooter[] = "<strong>Pertanggal :</strong>";
        $rowfooter[] = "<strong>" . $awal . " sampai " . $akhir . "</strong>";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $rowfooter[] = "";
        $data[] = $rowfooter;

        $output = array(
            "data" => $data
        );
        //output to json format
        echo json_encode($output);
    }

    public function invoice()
    {
        $id = $this->uri->segment(4);
        $data['user'] = $this->db->get_where('tabel_admin', ['email' =>
        $this->session->userdata('email')])->row_array();
        $data['billing'] = $this->db->get_where('tabel_transaksi_detail_billing', ['transaksi_id' => $id])->row_array();
        $data['order'] = $this->db->get_where('tabel_transaksi_detail', ['transaksi_id' => $id])->result_array();
        $data['transaksi'] = $this->db->get_where('tabel_transaksi', ['transaksi_id' => $id])->row_array();
        $data['member'] = $this->db->get_where('tabel_member', ['member_id' => $data['transaksi']['member_id']])->row_array();
        $data['title'] = 'Invoice #' . $id;
        $this->load->view('layoutadmin/transaksi/invoice', $data);
    }

    public function konfirmasiDapur()
    {
        $id = $this->input->post('id');
        $cekorder = $this->db->get_where('tabel_transaksi', array('transaksi_id' => $id))->row_array();
        $waktu = strtotime("+3 minutes", strtotime($cekorder['waktu']));
        $waktuNow = date('m/d/Y h:i:s a', time());
        $waktubatas = date('m/d/Y h:i:s a', $waktu);
        if ($waktuNow < $waktubatas) {
            $this->sukses_dapur($id);

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

            $data['hasil'] = 'terima';
            $data['id'] = $id;
            $pusher->trigger('dapur' . $id, 'konfirmasi', $data);
        } else {
            $this->db->where('transaksi_id', $id);
            $this->db->delete('tabel_transaksi');
        }
    }

    public function tolakDapur()
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

        $data['hasil'] = 'tolak';
        $pusher->trigger('dapur' . $id, 'konfirmasi', $data);
    }

    function sukses_dapur($id)
    {
        $lastTransaksi = $this->db->get_where('tabel_transaksi', array('transaksi_id' => $id))->row_array();
        $lastBilling = $this->db->get_where('tabel_transaksi_detail_billing', array('transaksi_id' => $id))->row_array();

        //midtrans
        $this->createMidtrans($id, $lastTransaksi['pembayaran'], $lastTransaksi['total'], $lastBilling['no_hp'], $lastBilling['email'], $lastBilling['nama_lengkap']);

        $output = array(
            "id" => $id
        );
        //output to json format
        echo json_encode($output);
    }

    public function createMidtrans($id, $bayar, $total, $hp, $email, $nama)
    {
        $params = array('server_key' => 'SB-Mid-server-dxzPS4HHLc9a8mRVEuqBOE-t', 'production' => false);
        $this->load->library('veritrans');
        $this->veritrans->config($params);

        $transaksi_detail = array(
            'order_id' => $id,
            'gross_amount' => $total,
        );

        $custom_expiry = array(
            'order_time' => date('Y-m-d H:i:s +0700'),
            'expiry_duration' => 20,
            'unit' => 'minute'
        );

        $customer_details = array(
            'first_name' => $nama,
            'email' => $email,
            'phone' => $hp
        );

        if ($bayar == 'mandiri') {
            $params = array(
                'transaction_details' => $transaksi_detail,
                'payment_type' => 'echannel',
                'echannel' => array(
                    'bill_info1' => 'Payment For:',
                    'bill_info2' => 'debt'
                ),
                'custom_expiry' => $custom_expiry,
                'customer_details'      => $customer_details
            );
        } else if ($bayar == 'gopay') {
            $params = array(
                'transaction_details' => $transaksi_detail,
                'payment_type' => 'gopay',
                'gopay' => array(
                    'enable_callback' => false
                ),
                'custom_expiry' => $custom_expiry,
                'customer_details'      => $customer_details
            );
        } else {
            $params = array(
                'transaction_details' => $transaksi_detail,
                'payment_type' => 'bank_transfer',
                'bank_transfer' => array(
                    'bank' => $bayar
                ),
                'custom_expiry' => $custom_expiry,
                'customer_details'      => $customer_details
            );
        }

        try {
            $response = $this->veritrans->vtdirect_charge($params);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if ($bayar == 'gopay') {
            $code_bayar = $response->actions[0]->url;
            $deeplink = $response->actions[1]->url;
        } else if ($bayar == 'mandiri') {
            $code_bayar = $response->bill_key;
            $deeplink = $response->biller_code;
        } else if ($bayar == 'permata') {
            $code_bayar = $response->permata_va_number;
            $deeplink = '';
        } else {
            $code_bayar = $response->va_numbers[0]->va_number;
            $deeplink = '';
        }

        $this->db->where('transaksi_id', $id);
        $this->db->update('tabel_transaksi', array(
            'status' => 2,
            'code_bayar' => $code_bayar,
            'deeplink' => $deeplink
        ));
    }
}
