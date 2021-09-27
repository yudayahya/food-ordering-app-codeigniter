<?php

class Mod_varian extends CI_Model
{

    function varian_list()
    {
        $hasil = $this->db->get('tabel_varian_saus');
        return $hasil->result();
    }

    function simpan($nama, $harga, $stock)
    {
        $hasil = $this->db->query("INSERT INTO tabel_varian_saus (nama_varian,harga,in_stock)
                                VALUES('$nama','$harga','$stock')");
        return $hasil;
    }

    function edit($nama, $harga, $stock)
    {
        $data = array(
            'nama_varian' => $nama,
            'harga'        => $harga,
            'in_stock'        => $stock
        );
        $this->db->where('varian_id', $this->input->post('kode'));
        $this->db->update('tabel_varian_saus', $data);
    }

    function hapus($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_varian_saus WHERE varian_id='$id'");
        return $hasil;
    }
}
