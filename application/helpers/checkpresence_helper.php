<?php
defined('BASEPATH') or die('No direct script access allowed!');

function check_presenceperday()
{
    $CI = &get_instance();
    $username = $CI->session->username;
    $CI->load->model('Presence_Model', 'presence');
    $user_presence = $CI->presence->presenceperday($username)->num_rows();
    if ($user_presence < 2) {
        $CI->session->set_userdata('present_warning', 'true');
    } else {
        $CI->session->set_userdata('present_warning', 'false');
    }
}

function check_hour($time, $hour_id, $raw = false)
{

    if ($time) {
        $CI = &get_instance();
        $CI->load->model('Hour_Model', 'hour');
        $presence_hour = $CI->hour->db->where('hour_id', $hour_id)->get('presence_hour')->row();

        if (($hour_id == 1 && ($time >= $presence_hour->start && $time <= $presence_hour->finished)) ||
            ($hour_id == 2 && ($time >= $presence_hour->start && $time <= $presence_hour->finished))
        ) {
            if ($raw) { 
                return [ 
                    'status' => 'on time',
                    'text' => $time
                ];
            } else {
                return '<span>' . $time .'</span>';
            }
        } else if ($hour_id == 1 && $time > $presence_hour->finished) {
            if ($raw) { 
                return [ 
                    'status' => 'out of time',
                    'text' => $time
                ];
            } else {
                return '<span>' . $time . '</span>';
            } 
        } else if ($hour_id == 2 && $time < $presence_hour->start) {
            if ($raw) { 
                return [ 
                        'status' => 'permission',
                        'text' => $time
                ];
                } else {
                return '<span>' . $time .'</span>';
            }
        } else if ($hour_id == 2 && $time > $presence_hour->finished) {
            if ($raw) { 
                return [ 
                        'status' => 'over time',
                        'text' => $time
                ];
                } else {
                return '<span>' . $time .'</span>';
            }
        }
    } else {
        if ($raw) {
            return
            [
                'status' => 'not present',
                'text' => '-'
            ]; 
            } else {
                return '<span>' . '-' .'</span>';
        }
    }
} 

function check_status($time, $hour_id, $raw = false)
{
    if ($time) {
        $CI = &get_instance();
        $CI->load->model('Hour_Model', 'hour');
        $presence_hour = $CI->hour->db->where('hour_id', $hour_id)->get('presence_hour')->row();

        if (($hour_id == 1 && ($time >= $presence_hour->start && $time <= $presence_hour->finished)) ||
            ($hour_id == 2 && ($time >= $presence_hour->start && $time <= $presence_hour->finished))) {   
            if ($raw) { 
                return [ 
                    'status' => 'on time', 
                    'text' => $time
                ];
            } else {
                return '<span class="badge badge-primary">' . 'on time' . '&nbsp&nbsp&nbsp&nbsp&nbsp' . '</span>';
            }
        } else if ($hour_id == 1 && $time > $presence_hour->finished) {
            if ($raw) { 
                return [ 
                    'status' => 'out of time', 
                    'text' => $time
                ];
            } else {
                return '<span class="badge badge-danger">' . 'out of time' . '&nbsp' . '</span>';
            } 
        } else if ($hour_id == 2 && $time < $presence_hour->start) {
            if ($raw) { 
                return [ 
                        'status' => 'permission', 
                        'text' => $time
                ];
            } else {
                return '<span class="badge badge-warning">' . 'permission' . '&nbsp' . '</span>';
            }
        } else if ($hour_id == 2 && $time > $presence_hour->finished) {
            if ($raw) { 
                return [ 
                        'status' => 'over time', 
                        'text' => $time
                ];
                } else {
                return '<span class="badge badge-success">' . 'over time' . '&nbsp' . '</span>';
            }
        }
    } else if(!$time){
        if ($raw) {
            return [
                'status' => 'not present', 
                'text' => '-'
            ];
        } else {
                return '<span class="badge badge-secondary">' . 'not present' . '</span>';
        }
    }
}

function is_weekend($date = false)
{
    $date = @$date ? $date : date('Y-m-d');
    return in_array(date('l', strtotime($date)), ['Saturday', 'Sunday']);
}