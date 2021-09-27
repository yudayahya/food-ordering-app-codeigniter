<?php

class Mod_member extends CI_Model
{

    function select_all()
    {
        $hasil = $this->db->query("SELECT * FROM `tabel_member`");
        return $hasil->result();
    }

    function simpan($nama, $username, $email, $pass)
    {
        $hasil = $this->db->query("INSERT INTO 
                                tabel_member (`nama_lengkap`,`username`,`email`,`password`,`gambar`,`is_active`,`status`)
                                VALUES('$nama','$username','$email','$pass','default.png','0','0')");
        return $hasil;
    }

    function update($nama, $hp, $lat, $lng, $id)
    {
        $data = array(
            'nama_lengkap'   => $nama,
            'no_hp'         => $hp,
            'lat'        => $lat,
            'lng'        => $lng,
        );

        $this->db->where('member_id', $id);
        $this->db->update('tabel_member', $data);
    }

    function gambar($id, $image)
    {
        $img = $this->db->get_where('tabel_member', array('member_id' => $id))->row_array();
        if ($img['gambar'] != 'default.png') {
            unlink(FCPATH . 'assets/gambar_member/' . $img['gambar']);
        }
        $data = array(
            'gambar'          => $image,
        );

        $this->db->where('member_id', $id);
        $this->db->update('tabel_member', $data);
    }

    function login_status($kondisi, $id)
    {
        if ($kondisi == 'login') {
            $this->db->where('member_id', $id);
            $this->db->update('tabel_member', array('status' => 1));
        } else {
            $this->db->where('member_id', $id);
            $this->db->update('tabel_member', array('status' => 0));
        }
    }
}
