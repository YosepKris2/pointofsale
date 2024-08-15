<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_dashboard extends CI_Model
{
    public function get_total_penjualan($start_date = null, $end_date = null)
    {
        $this->db->select('p.nama_produk, IFNULL(SUM(j.jumlah), 0) AS total_penjualan');
        $this->db->from('produk p');
        $this->db->join('penjualan j', 'j.id_produk = p.id_produk', 'left');
        $this->db->join('detail_penjualan d', 'j.no_trf = d.no_trf', 'left');
        if ($start_date && $end_date) {
            $this->db->where('d.tgl_trf >=', $start_date);
            $this->db->where('d.tgl_trf <=', $end_date);
        }
        $this->db->group_by('p.nama_produk');
        $this->db->order_by('total_penjualan', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_top_3_produk($start_date = null, $end_date = null)
    {
        $this->db->select('p.nama_produk, IFNULL(SUM(j.jumlah), 0) AS total_penjualan');
        $this->db->from('produk p');
        $this->db->join('penjualan j', 'j.id_produk = p.id_produk', 'left');
        $this->db->join('detail_penjualan d', 'j.no_trf = d.no_trf', 'left');
        if ($start_date && $end_date) {
            $this->db->where('d.tgl_trf >=', $start_date);
            $this->db->where('d.tgl_trf <=', $end_date);
        } else {
            $this->db->where('MONTH(d.tgl_trf) = MONTH(CURRENT_DATE)', null, false);
            $this->db->where('YEAR(d.tgl_trf) = YEAR(CURRENT_DATE)', null, false);
        }
        $this->db->group_by('p.nama_produk');
        $this->db->order_by('total_penjualan', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_penjualan_waktu_ke_waktu($start_date = null, $end_date = null)
    {
        $this->db->select('p.nama_produk, p.id_produk, dp.no_trf, dp.tgl_trf, SUM(j.jumlah) AS total_jumlah');
        $this->db->from('penjualan j');
        $this->db->join('produk p', 'p.id_produk = j.id_produk', 'inner');
        $this->db->join('detail_penjualan dp', 'dp.no_trf = j.no_trf', 'inner');
        if ($start_date && $end_date) {
            $this->db->where('dp.tgl_trf >=', $start_date);
            $this->db->where('dp.tgl_trf <=', $end_date);
        } else {
            $this->db->where('MONTH(dp.tgl_trf) = MONTH(CURRENT_DATE)', null, false);
            $this->db->where('YEAR(dp.tgl_trf) = YEAR(CURRENT_DATE)', null, false);
        }
        $this->db->group_by('p.nama_produk, dp.tgl_trf');
        $this->db->order_by('dp.tgl_trf');
        $query = $this->db->get();
        return $query->result();
    }
}


