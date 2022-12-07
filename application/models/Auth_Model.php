<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Auth_Model extends CI_Model
{
    public function login($username, $password)
    {
        $this->db->where('email', $username)->or_where('username', $username)->first();
        $user = $this->db->get('user')->row_array();

        //if user exists
        if ($user) {
            //if user is active 
            if ($user['is_active'] == 1) {
                // check password 
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('administrator');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The password is wrong.</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated.</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The email is not registered.</div>');
            redirect('auth');
        }
    }
}
