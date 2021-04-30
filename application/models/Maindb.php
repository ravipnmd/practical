<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Maindb extends CI_Model {

    function insert($table, $array) {
        $this->db->insert($table, $array);
        return $this->db->insert_id();
    }

    function get_events() {
        $qry = $this->db->select("*")->get('event_list');
        return $qry->result();
    }

    function delete($table, $array) {
        $qry = $this->db->where($array)->delete($table);
        return true;
    }

    function get_event_detail($event_id) {
        $qry = $this->db->select("*")->where('event_list_id', $event_id)->get('event_list');
        return $qry->row();
    }

    function get_event_dates($event_id) {
        $qry = $this->db->select("*")->where('event_list_id', $event_id)->get('event_dates');
        return $qry->result();
    }

    function update($table, $where, $set) {
        $return = "";
        $qry = $this->db->set($set)->where($where)->update($table);
        if ($qry) {
            $return = true;
        } else {
            $return = FALSE;
        }
        return $return;
    }
    
    function check_event($event_id) {
        $qry = $this->db->select("*")->where('event_list_id', $event_id)->get('event_list');
        return $qry->num_rows();
    }


}

?>