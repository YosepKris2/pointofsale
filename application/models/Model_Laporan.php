<?php

class Model_Laporan extends CI_Model
{
    function get_data()
    {
        return $this->db
            ->select('detail_penjualan.*, penjualan.no_trf, produk.nama_produk, pembayaran.metode, operator.nama_operator')
            ->join('penjualan', 'penjualan.no_trf = detail_penjualan.no_trf', 'left')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
            ->join('pembayaran', 'detail_penjualan.id_pembayaran = pembayaran.id_byr', 'inner')
            ->join('operator', 'detail_penjualan.operator = operator.nama_operator', 'left')
            ->group_by('detail_penjualan.no_trf')
            ->distinct()
            ->order_by('detail_penjualan.no_trf', 'ASC')
            ->get('detail_penjualan')->result();
    }

    function get_data_lap_sales()
    {
        return $this->db
            ->select('penjualan.*, detail_penjualan.*, produk.nama_produk, pembayaran.metode, operator.nama_operator')
            ->join('detail_penjualan', 'penjualan.id_transaksi = detail_penjualan.id', 'left')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
            ->join('pembayaran', 'detail_penjualan.id_pembayaran = pembayaran.id_byr', 'inner')
            ->join('operator', 'detail_penjualan.operator = operator.nama_operator', 'left')
            ->order_by('detail_penjualan.id', 'ASC')
            ->get('penjualan')->result();
    }

    function get_metode()
    {
        return $this->db->get('pembayaran')->result();
    }

    function get_sales()
    {
        return $this->db->select('id_operator, nama_operator')
                        ->where('id_akses', 3)
                        ->get('operator')
                        ->result();
    }

    function get_range($start, $end, $metode, $nama_pelanggan = '')
    {
        $this->db
            ->select('detail_penjualan.*, penjualan.no_trf, produk.nama_produk, pembayaran.metode, operator.nama_operator')
            ->join('penjualan', 'penjualan.no_trf = detail_penjualan.no_trf', 'left')
            ->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
            ->join('pembayaran', 'detail_penjualan.id_pembayaran = pembayaran.id_byr', 'inner')
            ->join('operator', 'detail_penjualan.operator = operator.nama_operator', 'left')
            ->where("tgl_trf >=", $start)
            ->where("tgl_trf <=", $end);

        if ($metode != '') {
            $this->db->where('id_pembayaran', $metode);
        }

        if ($nama_pelanggan != '') {
            $this->db->like('detail_penjualan.nama_pelanggan', $nama_pelanggan);
        }

        return $this->db
            ->group_by('detail_penjualan.no_trf')
            ->distinct()
            ->order_by('detail_penjualan.id', 'ASC')
            ->get('detail_penjualan')->result();
    }

    function hapus_trf($id)
    {
        $this->db->where('id', $id)->delete('detail_penjualan');
    }

    function hapus_id($id)
    {
        $this->db->where('id_transaksi', $id)->delete('penjualan');
    }
}