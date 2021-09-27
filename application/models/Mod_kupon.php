<?php

class Mod_kupon extends CI_Model
{

    function kupon_list()
    {
        $hasil = $this->db->get('tabel_kupon');
        return $hasil->result();
    }

    function simpan($kupon_nama, $valid_per_member, $last_date, $diskon, $minimum_spend, $maksimal_diskon, $kupon_type, $status)
    {
        $hasil = $this->db->query("INSERT INTO tabel_kupon (`kupon_nama`,`valid_per_member`,`last_date`,`diskon`,`minimum_spend`,`maksimal_diskon`,`kupon_type`,`status`)
                                VALUES('$kupon_nama','$valid_per_member','$last_date','$diskon','$minimum_spend','$maksimal_diskon','$kupon_type','$status')");
        return $hasil;
    }

    function changestatus($status)
    {
        $data = array(
            'status' => $status
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('tabel_kupon', $data);
    }

    function hapus($id)
    {
        $hasil = $this->db->query("DELETE FROM tabel_kupon WHERE id='$id'");
        return $hasil;
    }

    function user_kupon($id)
    {
        $hasil = $this->db->get_where('tabel_kupon_user', array('id_kupon' => $id));
        return $hasil->result();
    }

    function list_member($id)
    {
        $hasil = $this->db->query("SELECT * FROM tabel_member WHERE member_id NOT IN (SELECT id_member FROM tabel_kupon_user WHERE id_kupon=$id)");
        return $hasil->result();
    }
}
