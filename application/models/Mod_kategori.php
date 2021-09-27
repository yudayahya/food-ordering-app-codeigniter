<?php

class Mod_kategori extends CI_Model
{

    function kategori_list()
    {
        $hasil = $this->db->get('tabel_kategori');
        return $hasil->result();
    }

    function kategori_list_barang()
    {
        $hasil = $this->db->get_where('tabel_kategori', array(
            'parent >=' => 0
        ));
        return $hasil->result();
    }


    function select_parent()
    {
        return $this->db->get_where('tabel_kategori', array('parent <=' => 0));
    }

    function simpan($nama, $seo, $parent, $varian)
    {
        if ($parent != 0) {
            $data = array(
                'parent'        => -1
            );
            $this->db->where('kategori_id', $parent);
            $this->db->update('tabel_kategori', $data);

            $hasil = $this->db->query("INSERT INTO tabel_kategori (kategori_nama,parent,kategori_nama_seo,varian)
                                VALUES('$nama','$parent','$seo','$varian')");
            return $hasil;
        } else {
            $hasil = $this->db->query("INSERT INTO tabel_kategori (kategori_nama,parent,kategori_nama_seo,varian)
                                VALUES('$nama','$parent','$seo','$varian')");
            return $hasil;
        }
    }

    function edit($nama, $seo, $parent, $varian)
    {
        $data = array(
            'kategori_nama' => $nama,
            'parent'        => $parent,
            'kategori_nama_seo'     => $seo,
            'varian'     => $varian
        );
        $this->db->where('kategori_id', $this->input->post('kode'));
        $this->db->update('tabel_kategori', $data);
    }

    function hapus($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_kategori WHERE kategori_id='$id'");
        return $hasil;
    }
}
