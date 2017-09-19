<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clocker_model extends CI_Model
{

    public $table = 'external_clocker';
    public $id = 'idexternal_clocker';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('username', $this->session->identity);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('username', $this->session->identity);
        return $this->db->get($this->table)->row();
    }
    

}

/* End of file Clocker_model.php */
/* Location: ./application/models/Clocker_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-15 08:15:33 */
/* http://harviacode.com */