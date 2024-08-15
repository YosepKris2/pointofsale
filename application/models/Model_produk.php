<?php

class Model_produk extends CI_Model
{
    public function get_product($id) {
        $this->db->where('id_produk', $id);
        $query = $this->db->get('produk');
        return $query->row();
    }
    
    function tampil_data()
    {
        return $this->db->select('id_produk, nama_produk, range_harga, harga, harga_akhir')->from('produk')->get();
    }

    function post($data)
    {
        $this->db->insert('produk', $data);
    }

    public function getProductById($id)
    {
        $this->db->where('id_produk', $id);
        $query = $this->db->get('produk');
        return $query->row();
    }

    function get_one($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->get('produk');
    }

    function edit($data, $id)
    {
        $this->db->where('id_produk', $id);
        $this->db->update('produk', $data);
    }

    function hapus($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->delete('produk');
    }

    public function tambah_trf($data)
    {
        $this->db->insert('detail_penjualan', $data);
        return $this->db->insert_id();
    }

    public function hasilcari($key)
    {
        $this->db->select('id_produk, nama_produk, harga');
        $this->db->like('nama_produk', $key);
        $query = $this->db->get('produk');
        return $query->result();
    }

    public function count_filtered_products($key)
    {
        if ($key) {
            $this->db->like('nama_produk', $key);
        }
        return $this->db->count_all_results('produk');
    }

    public function filter_products($key, $limit, $start)
    {
        if ($key) {
            $this->db->like('id_produk', $key);
        }
        $this->db->limit($limit, $start);
        return $this->db->get('produk')->result();
    }

    public function get_detail_produk()
    {
        $this->db->select('*');
        $this->db->from('produk');
        $query = $this->db->get();
        return $query->result();
    }

    // Method to check if product name exists
    public function product_name_exists($nama_produk)
    {
        $this->db->where('nama_produk', $nama_produk);
        $query = $this->db->get('produk');
        return $query->num_rows() > 0;
    }
}
