<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Employee_Model extends CI_Model
{
    public function getAll()
    {
        $this->db->join('division', 'user.div_id = division.div_id', 'LEFT');
        return $this->db->get('user')->result();
    } 

    public function getEmployeebyuname($username)
    {
        $this->db->join('division', 'user.div_id = division.div_id', 'LEFT'); 
        $this->db->where('username', $username);
        return $this->db->get('user')->row();
    }

    public function getEmployeebyroleid()
    {
        $this->db->join('division', 'user.div_id = division.div_id', 'LEFT');
        $this->db->where('role_id', 2);
        return $this->db->get('user')->result();
    }

    public function update_data()
    {
        $data = [
            "firstName" => $this->input->post('firstName', true),
            "lastName" => $this->input->post('lastName', true),
            "div_id" => $this->input->post('div_id', true),
        ];

        $this->db->where('username', $this->input->post('username'));
        $this->db->update('user', $data);
    }

    public function delete_data($username)
    {
        $this->db->delete('user', ['username' => $username]);
    }
}
