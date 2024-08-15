<?php

class Model_lapbulanan extends CI_Model
{
	public function bulanan($thn)
	{
		return $this->db->select('tgl_trf, sum(grand_total) as gtotal')
			->from('detail_penjualan')
			->where('YEAR(tgl_trf)', $thn)
			->group_by('MONTH(tgl_trf)')
			->get()
			->result();
	}

	public function income()
	{
		return $this->db->select('sum(grand_total) as gtotal')
			->from('detail_penjualan')
			->where('MONTH(tgl_trf)', 'MONTH(CURRENT_DATE())', FALSE)
			->get()
			->row();
	}

	public function total_penjualan()
	{
		return $this->db->select('sum(jumlah) as total')
			->join('detail_penjualan', 'detail_penjualan.no_trf = penjualan.no_trf', 'left')
			->where('MONTH(detail_penjualan.tgl_trf)', 'MONTH(CURRENT_DATE())', FALSE)
			->from('penjualan')->get()->row();
	}

	public function total_transaksi()
	{
		return $this->db->select('count(id) as total')
			->where('MONTH(tgl_trf)', 'MONTH(CURRENT_DATE())', FALSE)
			->from('detail_penjualan')->get()->row();
	}

	public function produk_laris()
	{
		$query = $this->db->select('produk.nama_produk, sum(penjualan.jumlah) as total, detail_penjualan.tgl_trf')
			->from('penjualan')
			->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
			->join('detail_penjualan', 'detail_penjualan.no_trf = penjualan.no_trf', 'left')
			->group_by('produk.nama_produk')
			->order_by('total', 'DESC')
			->where('MONTH(detail_penjualan.tgl_trf)', 'MONTH(CURRENT_DATE())', FALSE)
			->limit(1)
			->get();

		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return FALSE;
		}
	}
}