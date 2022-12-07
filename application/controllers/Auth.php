<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{  
    
    public function __construct() { 
        parent::__construct();
        $this->load->library('form_validation');

        date_default_timezone_set('Asia/Jakarta');
    } 

    public function index() {  
        $this->form_validation->set_rules('username', 'username', 'required|trim'); 
        $this->form_validation->set_rules('password', 'password', 'required|trim'); 

        if($this->form_validation->run() == false) { 
        $data['title'] = 'Login';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('templates/auth_footer');
        } else { 
            $this->_login();
        }

    } 

    private function _login() { 
        $username = $this->input->post('username');
        $password = $this->input->post('password'); 

        $user = $this->db->get_where('user', ['username' => $username])->row_array(); 

        if($user) { 
            if($user['is_active'] == 1) { 
                if(password_verify($password, $user['password'])) { 
                    $data = [ 
                        'username' => $user['username'], 
                        'role_id' => $user['role_id']
                    ]; 
                    $this->session->set_userdata($data); 
                    if($user['role_id'] == 1) { 
                        redirect('administrator');
                    } else {
                    redirect('user/attendance'); 
                    }
                } else { 
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The password is wrong.</div>'); 
            redirect('auth');
                }

            } else { 
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The username has not been activated.</div>'); 
            redirect('auth');
            }
        } else { 
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The username has not been 
            registered.</div>'); 
            redirect('auth');
        }
    }

    public function register() {  
        $this->form_validation->set_rules('firstName', 'first name', 'required|trim'); 
        $this->form_validation->set_rules('lastName', 'last name', 'required|trim'); 
        $this->form_validation->set_rules('username', 'username', 'required|trim'); 
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email'); 
        $this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[8]|matches[password2]', 
        [
            'matches' => 'The password does not match.', 
            'min_length' => 'The password is too short'
        ]);

        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

        if($this->form_validation->run() == false) { 
            $data['title'] = 'Register';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register', $data);
            $this->load->view('templates/auth_footer');
        } else { 
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'firstName' => htmlspecialchars($this->input->post('firstName', true)), 
                'lastName' => htmlspecialchars($this->input->post('lastName', true)), 
                'email' => htmlspecialchars($this->input->post('email', true)), 
                'role_id' => 2, 
                'div_id' => 'D03', 
                'img' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'is_active' => 1, 
                'date_created' => time()
            ];

            $this->db->insert('user', $data); 

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account has 
            been registered. Please, login.</div>'); 
            redirect('auth');

        } 
    } 

    public function logout() { 
        $this->session->unset_userdata('username'); 
        $this->session->unset_userdata('role_id'); 

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have logged out.</div>'); 
            redirect('auth');
    } 

    public function blocked() { 
        $this->load->view('auth/blocked');
    }

}