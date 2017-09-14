<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fbpixel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Fb_pixel_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'premium/fbpixel/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'premium/fbpixel/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'premium/fbpixel/index.html';
            $config['first_url'] = base_url() . 'premium/fbpixel/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Fb_pixel_model->total_rows($q);
        $fbpixel = $this->Fb_pixel_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'fbpixel_data' => $fbpixel,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['aktif']      ='Premium';
        $data['title']       ='Admin Panel';
        $data['judul_menu']  ='Braja Marketindo';
        $data['nama_jln']    ='Jl.Lotus Timur, Jakasetia, Jawa Barat';
        $this->load->view('fbpixel/fb_pixel_list', $data);
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('premium/fbpixel/create_action'),
	    'idkonten' => set_value('idkonten'),
	    'konten' => set_value('konten'),
	    'username' => set_value('username'),
	);
        $data['aktif']      ='Premium';
        $data['title']       ='Admin Panel';
        $data['judul_menu']  ='Braja Marketindo';
        $data['nama_jln']    ='Jl.Lotus Timur, Jakasetia, Jawa Barat';
        $this->load->view('fbpixel/fb_pixel_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'konten' => $this->input->post('konten'),
		'username' => $this->session->identity,
	    );

            $this->Fb_pixel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('premium/fbpixel'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Fb_pixel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('premium/fbpixel/update_action'),
		'idkonten' => set_value('idkonten', $row->idkonten),
		'konten' => set_value('konten', $row->konten),
		'username' => set_value('username', $row->username),
	    );
            $data['aktif']      ='Premium';
            $data['title']       ='Admin Panel';
            $data['judul_menu']  ='Braja Marketindo';
            $data['nama_jln']    ='Jl.Lotus Timur, Jakasetia, Jawa Barat';
            $this->load->view('fbpixel/fb_pixel_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('premium/fbpixel'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idkonten', TRUE));
        } else {
            $data = array(
		'konten' => $this->input->post('konten'),
		'username' => $this->session->identity,
	    );

            $this->Fb_pixel_model->update($this->input->post('idkonten', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('premium/fbpixel'));
        }
    }
    
    public function _rules() 
    {
	$this->form_validation->set_rules('konten', 'konten', 'trim|required');

	$this->form_validation->set_rules('idkonten', 'idkonten', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Fbpixel.php */
/* Location: ./application/controllers/Fbpixel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-09-13 07:40:59 */
/* http://harviacode.com */