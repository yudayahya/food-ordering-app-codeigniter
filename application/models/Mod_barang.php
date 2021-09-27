<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_barang extends CI_Model
{

    function barang_list()
    {
        $hasil = $this->db->query("SELECT tb1.produk_id, tb1.produk_nama, tb1.harga, tb1.gambar, tb1.kategori_id , tb1.seller , tb1.in_stock , tb2.kategori_nama 
                                FROM `tabel_produk` as tb1, tabel_kategori as tb2
                                WHERE tb1.kategori_id=tb2.kategori_id ORDER BY tb1.produk_id DESC");
        return $hasil->result();
    }

    function simpan_barang($nabar, $harga, $seo, $gambar, $kategori, $seller, $stock)
    {
        $hasil = $this->db->query("INSERT INTO 
                                tabel_produk (produk_nama,produk_nama_seo,harga,gambar,kategori_id,seller,in_stock)
                                VALUES('$nabar','$seo','$harga','$gambar','$kategori','$seller','$stock')");
        return $hasil;
    }

    function edit_barang($id, $nabar, $harga, $seo, $gambar, $kategori, $seller, $stock)
    {
        if ($gambar == $this->input->post('imagename')) {
            $data = array(
                'produk_nama'       => $nabar,
                'harga'             => $harga,
                'produk_nama_seo'   => $seo,
                'kategori_id'       => $kategori,
                'seller'            => $seller,
                'in_stock'          => $stock
            );
        } else {
            $img = $this->db->get_where('tabel_produk', array('produk_id' => $id))->row_array();
            if ($img['gambar'] != 'default.png') {
                unlink(FCPATH . 'assets/gambar_produk/' . $img['gambar']);
            }
            $data = array(
                'produk_nama'       => $nabar,
                'harga'             => $harga,
                'gambar'            => $gambar,
                'produk_nama_seo'   => $seo,
                'kategori_id'       => $kategori,
                'seller'            => $seller,
                'in_stock'          => $stock
            );
        }

        $this->db->where('produk_id', $id);
        $this->db->update('tabel_produk', $data);
    }

    function hapus_barang($id)
    {
        $img = $this->db->get_where('tabel_produk', array('produk_id' => $id))->row_array();
        if ($img['gambar'] != 'default.png') {
            unlink(FCPATH . 'assets/gambar_produk/' . $img['gambar']);
        }
        $hasil = $this->db->query("DELETE FROM tabel_produk WHERE produk_id='$id'");
        return $hasil;
    }

    function keterangan()
    {
        $data = array(
            'keterangan'        => $this->input->post('content'),
        );
        $this->db->where('produk_id', $this->input->post('id'));
        $this->db->update('tabel_produk', $data);
    }
}
