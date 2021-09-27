<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_banner extends CI_Model
{

    function banner_list()
    {
        $hasil = $this->db->query("SELECT * FROM `tabel_banner`");
        return $hasil->result();
    }

    function simpan_banner($judul, $seo, $ket, $gambar)
    {
        $hasil = $this->db->query("INSERT INTO 
                                tabel_banner (nama_banner,nama_banner_seo,keterangan,`image`)
                                VALUES('$judul','$seo','$ket','$gambar')");
        return $hasil;
    }

    function edit_banner($id, $judul, $seo, $ket, $gambar)
    {
        if ($gambar == $this->input->post('imagename')) {
            $data = array(
                'nama_banner'       => $judul,
                'nama_banner_seo'   => $seo,
                'keterangan'       => $ket
            );
        } else {
            $img = $this->db->get_where('tabel_banner', array('id' => $id))->row_array();
            if ($img['image'] != 'default.png') {
                unlink(FCPATH . 'assets/banner/' . $img['image']);
            }
            $data = array(
                'nama_banner'       => $judul,
                'nama_banner_seo'   => $seo,
                'keterangan'       => $ket,
                'image'          => $gambar
            );
        }

        $this->db->where('id', $id);
        $this->db->update('tabel_banner', $data);
    }

    function hapus_banner($id)
    {
        $img = $this->db->get_where('tabel_banner', array('id' => $id))->row_array();
        if ($img['image'] != 'default.png') {
            unlink(FCPATH . 'assets/banner/' . $img['image']);
        }
        $hasil = $this->db->query("DELETE FROM tabel_banner WHERE id='$id'");
        return $hasil;
    }
}
