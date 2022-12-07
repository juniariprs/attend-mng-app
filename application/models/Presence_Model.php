<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Presence_Model extends CI_Model
{

    public function presenceperday($username)
    {
        $today = date('Y-m-d');
        $this->db->where('date', $today);
        $this->db->where('username', $username);
        return $this->db->get('presence');
    }

    public function insert_data($data)
    {
        $this->db->insert('presence', $data);
    } 

    public function getPresenceperDay()
    {   
        $today = date('Y-m-d');
        $this->db->where('date', $today);
        $this->db->join('user', 'presence.username = user.username', 'LEFT');
        $this->db->join('presence_hour', 'presence.hour_id = presence_hour.hour_id', 'LEFT');
        return $this->db->order_by('time')->get('presence')->result();
    }

    public function getPresenceperDaybyuname()
    {
        $username = $this->session->userdata('username');
        $today = date('Y-m-d'); 
        $this->db->where('username', $username);
        $this->db->where('date', $today);
        $this->db->join('presence_hour', 'presence.hour_id = presence_hour.hour_id', 'LEFT');
        return $this->db->get('presence')->result();
    } 
    
    public function getCountPresent()
    {
        $today = date('Y-m-d');

        $present = $this->db->select('*')->from('presence')
            ->where('hour_id', 1)->where('date', $today)->count_all_results();
        return $present;
    } 

    public function getCountNotPresent() { 
        $today = date('Y-m-d'); 

        $present = $this->db->select('*')->from('presence')
            ->where('hour_id', 1)->where('date', $today)->count_all_results(); 
        $employees_many = $this->db->select('*')->from('user')->where('role_id', 2)->count_all_results(); 
        $not_present = $employees_many - $present; 
        return $not_present;
    }

    public function getPresenceReport($username, $month, $year)
    {
        $this->db->select("DATE_FORMAT(a.date, '%Y-%m-%d') AS date, a.time AS get_in_h, (SELECT b.time FROM presence b WHERE b.date = a.date AND b.hour_id != a.hour_id AND b.username = a.username) AS get_out_h");
        $this->db->where('username', $username);
        $this->db->where("DATE_FORMAT(date, '%m') = ", $month);
        $this->db->where("DATE_FORMAT(date, '%Y') = ", $year);
        $this->db->group_by("date");
        return $this->db->get('presence a')->result_array();
    }

}
