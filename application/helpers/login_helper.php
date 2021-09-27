<?php

function is_logged_in_admin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('admin/auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(2);

        $queryMenu = $ci->db->get_where('tabel_menu_admin', ['link' => $menu])->row_array();
        $menu_id = $queryMenu['menu_id'];

        $userAccess = $ci->db->get_where('tabel_admin_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('admin/auth/blocked');
        }
    }
}
