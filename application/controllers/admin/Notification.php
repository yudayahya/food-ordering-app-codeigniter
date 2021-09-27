<?php

class Notification extends CI_Controller
{
    public function getverify()
    {
        $result = $this->db->order_by('transaksi_id', 'DESC')->get_where('tabel_transaksi', array('status' => 1))->result_array();
        $total = count($result);
        $output = '';
        $output .= '<li class="header">Kamu memiliki ' . $total . ' notifikasi untuk konfirmasi dapur :</li>
                    <li>
                    <ul class="menu">';

        foreach ($result as $r) {
            $member = $this->db->get_where('tabel_member', array('member_id' => $r['member_id']))->row_array();
            $output .= '<li>
                        <a href="' . base_url('admin/transaksi/detail/') . $r['transaksi_id'] . '">
                        <i class="fa fa-shopping-cart text-green"></i> Order atas nama <strong>' . $member['nama_lengkap'] . '</strong>.
                        </a>
                        </li>';
        }

        $output .= '</ul></li>
                    <li class="footer"><a href="' . base_url('admin/transaksi') . '">View all</a>
                    </li>';

        return array(
            'result' => $output,
            'total' => $total
        );
    }

    public function notify()
    {
        echo json_encode($this->getverify());
    }
}
