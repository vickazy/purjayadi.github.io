<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{

    public $table = 'pembayaran';
    public $id = 'idpembayaran';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    //update status pembayaran
    function updatepembayaran($id){
        return $this->db->query("UPDATE pembayaran set status=status+1 where idpembayaran='".$this->db->escape_str($id)."'");
    }


    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('idpembayaran', $q);
	$this->db->or_like('kode_user', $q);
	$this->db->or_like('nama_pengirim', $q);
	$this->db->or_like('tgl_transfer', $q);
	$this->db->or_like('photo', $q);
	$this->db->or_like('jmlh_transfer', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('idpembayaran', $q);
	$this->db->or_like('kode_user', $q);
	$this->db->or_like('nama_pengirim', $q);
	$this->db->or_like('tgl_transfer', $q);
	$this->db->or_like('photo', $q);
	$this->db->or_like('jmlh_transfer', $q);
	$this->db->or_like('status', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Pembayaran_model.php */
/* Location: ./application/models/Pembayaran_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-11 04:59:41 */
/* http://harviacode.com */