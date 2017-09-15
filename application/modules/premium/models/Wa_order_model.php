<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wa_order_model extends CI_Model
{

    public $table = 'wa_order';
    public $id = 'idwa_order';
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
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->or_like('no_wa', $q);
        $this->db->where('username', $this->session->identity);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
    	$this->db->or_like('no_wa', $q);
        $this->db->where('username', $this->session->identity);
    	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->where('username', $this->session->identity);
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->where('username', $this->session->identity);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('username', $this->session->identity);
        $this->db->delete($this->table);
    }


    public function buat_kode()   {
          $this->db->select('RIGHT(wa_order.idwa_order,4) as kode', FALSE);
          $this->db->order_by('idwa_order','DESC');    
          $this->db->limit(1);    
          $query = $this->db->get('wa_order');      //cek dulu apakah ada sudah ada kode di tabel.    
          if($query->num_rows() <> 0){      
           //jika kode ternyata sudah ada.      
           $data = $query->row();      
           $kode = intval($data->kode) + 1;    
          }
          else {      
           //jika kode belum ada      
           $kode = 1;    
          }
          $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
          $kodejadi = "WA-01-".$kodemax;    // hasilnya ODJ-9921-0001 dst.
          return $kodejadi;   
    }
  

}

/* End of file Wa_order_model.php */
/* Location: ./application/models/Wa_order_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-14 08:05:41 */
/* http://harviacode.com */