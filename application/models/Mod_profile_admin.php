<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_profile_admin extends CI_Model
{

    function admin_list()
    {
        $hasil = $this->db->query("SELECT * FROM `tabel_admin`");
        return $hasil->result();
    }

    function edit($id, $nama, $pass)
    {
        $data = array(
            'nama'           => $nama,
            'password'       => $pass,
        );

        $this->db->where('id', $id);
        $this->db->update('tabel_admin', $data);
    }

    function upload_image($email, $image)
    {
        $img = $this->db->get_where('tabel_admin', array('email' => $email))->row_array();
        if ($img['image'] != 'default.png') {
            unlink(FCPATH . 'assets/gambar_admin/' . $img['image']);
        }
        $data = array(
            'image'          => $image
        );
        $this->db->where('email', $email);
        $this->db->update('tabel_admin', $data);
    }
}
