<?php

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        chek_session();
        $this->load->model('Model_produk');
    }

    function index()
    {
        $data['record'] = $this->Model_produk->tampil_data()->result();
        //$data['detail_produk'] = $this->Model_produk->get_detail_produk();
        $this->template->load('template/template', 'produk/lihat_data', $data);
        $this->load->view('template/datatables');
    }

    function post()
    {
        if (isset($_POST["submit"])) {
            $nama = $this->input->post('nama_produk');
            $harga_awal = $this->input->post('harga_awal');
            $harga_akhir = $this->input->post('harga_akhir');
            $range_harga = 'Rp.' . $harga_awal . ' - Rp.' . $harga_akhir;

            // Check if the product name already exists
            if ($this->Model_produk->product_name_exists($nama)) {
                $this->session->set_flashdata('message', 'Nama Produk sudah ada, silakan gunakan nama lain!');
                redirect('produk/post'); // Redirect back to the form with an error message
            } else {
                $data = array(
                    'nama_produk' => $nama,
                    'harga' => $harga_awal,
                    'harga_akhir' => $harga_akhir,
                    'range_harga' => $range_harga
                );

                $this->Model_produk->post($data);
                $this->session->set_flashdata('message', 'Data Produk berhasil ditambahkan!');
                redirect('produk');
            }
        } else {
            $data['detail_produk'] = $this->Model_produk->get_detail_produk();
            $this->template->load("template/template", "produk/form_input", $data);
        }
    }

    function edit()
    {
        if (isset($_POST['submit'])) {
            $id = $this->input->post('id_produk');
            $nama = $this->input->post('nama_produk');
            $harga_awal = $this->input->post('harga_awal');
            $harga_akhir = $this->input->post('harga_akhir');

            $data = array(
                'nama_produk' => $nama,
                'harga' => $harga_awal,
                'harga_akhir' => $harga_akhir
            );

            $this->Model_produk->edit($data, $id);
            $this->session->set_flashdata('message', 'Data Produk berhasil dirubah!');
            redirect('produk');
        } else {
            $id = $this->uri->segment(3);
            $data['record'] = $this->Model_produk->get_one($id)->row_array();
            $this->template->load("template/template", "produk/form_edit", $data);
        }
    }

    function hapus()
    {
        $id = $this->uri->segment(3);
        $this->Model_produk->hapus($id);
        $this->session->set_flashdata('message', 'Data Produk berhasil dihapus!');
        redirect('produk');
    }
}
