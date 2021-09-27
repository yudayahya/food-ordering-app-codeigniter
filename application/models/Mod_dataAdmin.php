<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_dataAdmin extends CI_Model
{

    function admin_list()
    {
        $hasil = $this->db->query("SELECT * FROM `tabel_admin` WHERE id>1");
        return $hasil->result();
    }

    function simpan($nama, $username, $email, $pass, $image, $role)
    {
        $hasil = $this->db->query("INSERT INTO 
                                tabel_admin (`nama`,`username`,`email`,`image`,`password`,`role_id`)
                                VALUES('$nama','$username','$email','$image','$pass','$role')");
        return $hasil;
    }

    function edit($id, $nama, $pass, $image)
    {
        if ($image == $this->input->post('imagename')) {
            $data = array(
                'nama'           => $nama,
                'password'       => $pass,
            );
        } else {
            $img = $this->db->get_where('tabel_admin', array('id' => $id))->row_array();
            if ($img['image'] != 'default.png') {
                unlink(FCPATH . 'assets/gambar_admin/' . $img['image']);
            }
            $data = array(
                'nama'           => $nama,
                'password'       => $pass,
                'image'          => $image,
            );
        }

        $this->db->where('id', $id);
        $this->db->update('tabel_admin', $data);
    }

    function hapus($id)
    {
        $img = $this->db->get_where('tabel_admin', array('id' => $id))->row_array();
        if ($img['image'] != 'default.png') {
            unlink(FCPATH . 'assets/gambar_admin/' . $img['image']);
        }
        $hasil = $this->db->query("DELETE FROM tabel_admin WHERE id='$id'");
        return $hasil;
    }
}
