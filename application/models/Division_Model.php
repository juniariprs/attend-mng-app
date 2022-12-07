<?php
defined('BASEPATH') or die('No direct script access allowed!');

class Division_Model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get('division')->result();
    }

    public function getDivisionbydivid($div_id)
    {
        return $this->db->get_where('division', ['div_id' => $div_id])->row();
    }

    public function insert_data()
    {
        $data = [
            "div_id" => $this->input->post('div_id', true),
            "div_name" => $this->input->post('div_name', true),
        ];

        $this->db->insert('division', $data);
    }

    public function update_data()
    {
        $data = [
            "div_id" => $this->input->post('div_id', true),
            "div_name" => $this->input->post('div_name', true),
        ];

        $this->db->where('div_id', $this->input->post('div_id'));
        $this->db->update('division', $data);
    }

    public function delete_data($div_id)
    {
        $this->db->delete('division', ['div_id' => $div_id]);
    }
}
