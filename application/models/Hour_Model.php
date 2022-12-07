<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Hour_Model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('presence_hour')->result();
    }

    public function getHourbyhourid($hour_id)
    { 
        $this->db->where('hour_id', $hour_id);
        return $this->db->get('presence_hour')->row();
    }

    public function update_data()
    {
        $data = [
            "start" => $this->input->post('start', true),
            "finished" => $this->input->post('finished', true),
        ];

        $this->db->where('hour_id', $this->input->post('hour_id'));
        $this->db->update('presence_hour', $data);
    } 
}