<?php

class Lapsales extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_laporan');
    }

    function index($start = null , $end = null)
    {
        if (isset($_POST['search'])) {
            $start = $this->input->post('start_date');
            $end = $this->input->post('end_date');
            $metode = $this->input->post('metode');
            $sales_name = $this->input->post('sales_name');

            $data['laporan'] = $this->Model_laporan->get_range($start, $end, $metode, $sales_name);
            $data['metode'] = $this->Model_laporan->get_metode();
            $data['sales_list'] = $this->Model_laporan->get_sales();

            $this->template->load('template/template', 'lapsales/lihat_data', $data);
            $this->load->view('template/datatables');
        } else {
            $data['laporan'] = $this->Model_laporan->get_data();
            $data['metode'] = $this->Model_laporan->get_metode();
            $data['sales_list'] = $this->Model_laporan->get_sales();

            $this->template->load('template/template', 'lapsales/lihat_data', $data);
            $this->load->view('template/datatables');
        }
    }

    function hapus($id)
    {
        $this->Model_laporan->hapus_trf($id);
        $this->Model_laporan->hapus_id($id);
    }
}
