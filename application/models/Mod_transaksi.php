<?php

class Mod_transaksi extends CI_Model
{
    function select_confirm()
    {
        $sql = "SELECT tb1.*,tb2.nama_lengkap
              FROM tabel_transaksi as tb1, tabel_member as tb2 
              WHERE tb1.status=1 AND tb1.member_id=tb2.member_id ORDER BY transaksi_id DESC";
        return $this->db->query($sql);
    }

    function select_pending()
    {
        $sql = "SELECT tb1.*,tb2.nama_lengkap
              FROM tabel_transaksi as tb1, tabel_member as tb2 
              WHERE tb1.status=2 AND tb1.member_id=tb2.member_id ORDER BY transaksi_id DESC";
        return $this->db->query($sql);
    }

    function select_memasak()
    {
        $sql = "SELECT tb1.*,tb2.nama_lengkap
              FROM tabel_transaksi as tb1, tabel_member as tb2 
              WHERE tb1.status=3 AND tb1.member_id=tb2.member_id ORDER BY transaksi_id DESC";
        return $this->db->query($sql);
    }

    function select_mengirim()
    {
        $sql = "SELECT tb1.*,tb2.nama_lengkap
              FROM tabel_transaksi as tb1, tabel_member as tb2 
              WHERE tb1.status=4 AND tb1.member_id=tb2.member_id ORDER BY transaksi_id DESC";
        return $this->db->query($sql);
    }

    function select_done()
    {
        $sql = "SELECT tb1.*,tb2.nama_lengkap
              FROM tabel_transaksi as tb1, tabel_member as tb2 
              WHERE tb1.status=5 AND tb1.member_id=tb2.member_id ORDER BY transaksi_id DESC";
        return $this->db->query($sql);
    }

    function select_expired()
    {
        $sql = "SELECT tb1.*,tb2.nama_lengkap
              FROM tabel_transaksi as tb1, tabel_member as tb2 
              WHERE tb1.status=6 AND tb1.member_id=tb2.member_id ORDER BY transaksi_id DESC";
        return $this->db->query($sql);
    }

    function select_done_by_date($awal, $akhir)
    {
        $sql = "SELECT tb1.*,tb2.nama_lengkap
              FROM tabel_transaksi as tb1, tabel_member as tb2 
              WHERE tb1.status=5 AND tb1.member_id=tb2.member_id AND tb1.tanggal>='$awal' AND tb1.tanggal<='$akhir' ORDER BY transaksi_id DESC";
        return $this->db->query($sql);
    }

    function update()
    {
        $cek = $this->input->post('status');
        if ($cek == 1) {
            $this->db->where('transaksi_id', $this->input->post('id'));
            $this->db->update('tabel_transaksi', array(
                'status' => $cek,
                'for_event' => 1
            ));
        } else {
            $this->db->where('transaksi_id', $this->input->post('id'));
            $this->db->update('tabel_transaksi', array(
                'status' => $cek,
                'for_event' => 0
            ));
        }
    }

    function delete_expired()
    {
        $hasil = $this->db->query("DELETE FROM tabel_transaksi WHERE `status`=6");
        return $hasil;
    }
}
