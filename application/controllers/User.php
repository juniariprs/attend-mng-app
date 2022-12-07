<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        is_login();

        date_default_timezone_set('Asia/Jakarta'); 

        $this->load->model('Presence_Model', 'presence');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    } 


    public function attendance() { 
        $data['title'] = 'Attendance';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $data['presence'] = $this->presence->presenceperday($this->session->userdata('username'))->num_rows();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/attendance', $data);
        $this->load->view('templates/footer');
    } 

    public function presence(){ 
        if (@$this->uri->segment(3)) {
            $hour_id = ucfirst($this->uri->segment(3));
        } else {
            $presenceperday = $this->presence->presenceperday($this->session->userdata('username'))->num_rows();
            $hour_id = ($presenceperday < 2 && $presenceperday < 1) ? 1 : 2;
        }

        $data = [
            'date' => date('Y-m-d'),
            'time' => date('H:i:s'),
            'hour_id' => $hour_id,
            'username' => $this->session->userdata('username')
        ];

        $this->presence->insert_data($data); 
        $this->session->set_flashdata('flash', 'recorded');

        redirect('user/my_presence_history');
    }

    public function my_profile() 
    { 
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/my_profile', $data);
        $this->load->view('templates/footer');
    } 
    

    public function edit_profile() { 
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $this->form_validation->set_rules('firstName', 'first name', 'required|trim'); 
        $this->form_validation->set_rules('lastName', 'last name', 'required|trim'); 

        if($this->form_validation->run() == false) { 
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit_profile', $data);
            $this->load->view('templates/footer');
        } else { 
            $username = $this->input->post('username');
            $firstName = $this->input->post('firstName'); 
            $lastName = $this->input->post('lastName'); 
            $email = $this->input->post('email');
            
            $upload_img = $_FILES['img']; 

            if($upload_img) { 
                $config['upload_path']          = './assets/img/profile';
                $config['allowed_types']        = 'jpg|jpeg';
                $config['max_size']             = 1024;
                $this->load->library('upload', $config); 

                if($this->upload->do_upload('img')) { 
                    $new_img = $this->upload->data('file_name'); 
                    $this->db->set('img', $new_img);
                }
                else { 
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('firstName', $firstName); 
            $this->db->set('lastName', $lastName); 
            $this->db->set('email', $email); 
            $this->db->where('username', $username);
            $this->db->update('user');

            $this->session->set_flashdata('flash', 'updated');
            redirect('user/my_profile');
        }
    } 

    public function change_password() { 
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $this->form_validation->set_rules('current_password', 'current password', 'required|trim'); 
        $this->form_validation->set_rules('new_password1', 'new password', 'required|trim|min_length[8]|matches[new_password2]');  
        $this->form_validation->set_rules('new_password2', 'new password confirmation', 'required|trim|min_length[8]|matches[new_password1]');  

        if($this->form_validation->run() == false) { 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/change_password', $data);
        $this->load->view('templates/footer'); 
        } else { 
            $current_password = $this->input->post('current_password'); 
            $new_password = $this->input->post('new_password1'); 

            if(!password_verify($current_password, $data['user']['password'])) { 
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The current password is wrong.</div>'); 
            redirect('user/change_password');
            } else { 
                if($current_password == $new_password1) { 
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">The new password cannot be the same as the current password.</div>'); 
            redirect('user/change_password');

                } else { 
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT); 

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username')); 
                    $this->db->update('user'); 

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">The password has been changed.</div>'); 
            redirect('user/change_password');
                }
            }
        }
    }

    public function my_presence_history() { 
        $data['title'] = 'My Presence History';
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array(); 

        $data['presence'] = $this->presence->getPresenceperDaybyuname();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/my_presence_history', $data);
        $this->load->view('templates/footer');
    } 

}