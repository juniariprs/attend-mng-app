<?php

function is_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu_name = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu_name' => $menu_name])->row_array();
        $menu_id = $queryMenu['menu_id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        if (($userAccess)->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}
