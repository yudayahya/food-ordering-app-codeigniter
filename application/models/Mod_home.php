<?php

class Mod_home extends CI_Model
{

    function getProduk()
    {
        return $this->db->query("select * from tabel_produk where seller=1 limit 6");
    }

    function getRekomendasiProduk()
    {
        return $this->db->query("select * from tabel_produk where seller=1")->result_array();
    }

    function getNewProduk()
    {
        return $this->db->query("select * from tabel_produk ORDER BY produk_id DESC limit 6");
    }

    function getAllProduk($limit, $start)
    {
        return $this->db->get('tabel_produk', $limit, $start)->result_array();
    }

    function getAllProdukLow($limit, $start)
    {
        return $this->db->order_by('harga', 'ASC')->get('tabel_produk', $limit, $start)->result_array();
    }

    function getAllProdukHigh($limit, $start)
    {
        return $this->db->order_by('harga', 'DESC')->get('tabel_produk', $limit, $start)->result_array();
    }

    function countAll()
    {
        return $this->db->get('tabel_produk')->num_rows();
    }

    function getProdukByKategori($limit, $start, $kategori)
    {
        return $this->db->get_where('tabel_produk', array('kategori_id' => $kategori), $limit, $start)->result_array();
    }

    function countAllByKategori($kategori)
    {
        return $this->db->get_where('tabel_produk', array('kategori_id' => $kategori))->num_rows();
    }

    public function search($keyword)
    {
        $this->db->like('produk_nama', $keyword);
        $result = $this->db->get('tabel_produk')->result_array();

        return $result;
    }
}
