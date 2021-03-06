<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mainmodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function produk(){
        $this->db->order_by('id_produk', 'DESC');
        return $this->db->get('produk');
    }

    function waorder()
    {
    	# code...
    	$this->db->order_by('idwa_order', 'DESC');
    	$this->db->where('username', $this->session->identity);
    	return $this->db->get('wa_order');
    }

    function news()
    {
    	# code...
    	$this->db->order_by('idclocker', 'DESC');
    	$this->db->where('username', $this->session->identity);
    	return $this->db->get('clocker');
    }

    function info()
    {
        # code...
        $this->db->order_by('idexternal_clocker', 'DESC');
        $this->db->where('username', 'admin');
        return $this->db->get('external_clocker');
    }

    function fbpixel()
    {
        # code...
        $this->db->order_by('idkonten', 'DESC');
        $this->db->where('username', 'admin');
        return $this->db->get('fb_pixel');
    }

}