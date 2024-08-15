<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_dashboard');
	}

	public function index()
{
    $start_date = $this->input->post('start_date');
    $end_date = $this->input->post('end_date');

    $data['box'] = $this->box();
    $data['total_penjualan'] = $this->Model_dashboard->get_total_penjualan($start_date, $end_date);
    $data['top_3_produk'] = $this->Model_dashboard->get_top_3_produk($start_date, $end_date);
    $data['penjualan_waktu_ke_waktu'] = $this->Model_dashboard->get_penjualan_waktu_ke_waktu($start_date, $end_date);
    
	//print_r($data['total_penjualan']); die();
	
	$this->template->load('template/template', 'dashboard/lihat_dashboard', $data);
}

	public function box()
	{
		$box = []; // Replace this with the actual method to get the box data
		$info_box = json_decode(json_encode($box), FALSE);
		return $info_box;
	}
}
