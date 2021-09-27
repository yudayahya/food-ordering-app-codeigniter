<?php

class Mod_chat extends CI_Model
{
    function select_member($id_member)
    {
        $sql = "SELECT * FROM tabel_member WHERE member_id='$id_member'";
        return $this->db->query($sql);
    }

    function chat_list($id_member)
    {
        $sql = "SELECT * FROM tabel_message WHERE pengirim_msg_id='$id_member' OR penerima_msg_id='$id_member'";
        return $this->db->query($sql);
    }

    function last_chat()
    {
        $sql = "SELECT max(`tabel_message`.`msg_id`) as `id_message`,(SELECT `email` FROM `tabel_member` WHERE `tabel_member`.`member_id` = `tabel_message`.`pengirim_msg_id` OR `tabel_member`.`member_id`=`tabel_message`.`penerima_msg_id`) as `emailmember` FROM `tabel_message` GROUP BY `emailmember` ORDER BY `id_message` DESC";
        return $this->db->query($sql);
    }

    function list_member()
    {
        $sql = "SELECT * FROM `tabel_member` WHERE NOT EXISTS (SELECT * FROM `tabel_message` WHERE `tabel_member`.`member_id` = `tabel_message`.`pengirim_msg_id` OR `tabel_member`.`member_id` = `tabel_message`.`penerima_msg_id`)";
        return $this->db->query($sql);
    }

    function simpan_text($datetime, $pengirim, $penerima, $message, $type, $status)
    {
        $hasil = $this->db->query("INSERT INTO tabel_message (`msg_timestamp`,`pengirim_msg_id`,`penerima_msg_id`,`message`,`msg_type`,`status`)
                                VALUES('$datetime','$pengirim','$penerima','$message','$type','$status')");
        return $hasil;
    }

    function chat_read_member($id_member)
    {
        $sql = "SELECT * FROM tabel_message WHERE penerima_msg_id='$id_member' AND `status`=0";
        foreach ($this->db->query($sql)->result_array() as $chat) {
            $this->db->where('msg_id', $chat['msg_id']);
            $this->db->update('tabel_message', array('status' => 1));
        }
    }

    function chat_read_admin($id_member)
    {
        $sql = "SELECT * FROM tabel_message WHERE pengirim_msg_id='$id_member' AND `status`=0";
        foreach ($this->db->query($sql)->result_array() as $chat) {
            $this->db->where('msg_id', $chat['msg_id']);
            $this->db->update('tabel_message', array('status' => 1));
        }
    }

    function chat_delete($id_member)
    {
        $sql = "SELECT * FROM tabel_message WHERE pengirim_msg_id='$id_member' OR penerima_msg_id='$id_member'";
        $chat = $this->db->query($sql);

        foreach ($chat->result_array() as $c) {
            if ($c['msg_type'] == 1) {
                unlink(FCPATH . 'assets/gambar_chatting/' . $c['message']);
            }
        }

        $hasil = $this->db->query("DELETE FROM tabel_message WHERE pengirim_msg_id='$id_member' OR penerima_msg_id='$id_member'");
        return $hasil;
    }
}
