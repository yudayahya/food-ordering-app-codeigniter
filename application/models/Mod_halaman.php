<?php

class Mod_halaman extends CI_Model
{

    function select_all()
    {
        $hasil = $this->db->query("SELECT * FROM `tabel_pages`");
        return $hasil->result();
    }

    function select_parent()
    {
        return $this->db->get_where('tabel_pages', array('parent' => 0));
    }

    function simpan()
    {
        $data = array(
            'judul'        => $this->input->post('judul'),
            'content'      => $this->input->post('content'),
            'judul_seo'    => seo_title($this->input->post('judul'))
        );

        $this->db->insert('tabel_pages', $data);
    }

    function edit()
    {
        $data = array(
            'judul'        => $this->input->post('judul'),
            'content'      => $this->input->post('content'),
            'judul_seo'    => seo_title($this->input->post('judul'))
        );
        $this->db->where('pages_id', $this->input->post('id'));
        $this->db->update('tabel_pages', $data);
    }
}
