<?php

class Model_penjualan extends CI_Model
{
	public $id = 'id_produk';

	public function lihat_barang($id)
	{
		$query = $this->db->select('id_produk as id, nama_produk as nama_produk, harga, range_harga, COUNT(nama_produk) as jumlah')
			->where('id_produk', $id)
			->get('produk');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return null;
		}
	}

	function hasilcari($key)
	{
		return $this->db->or_like('nama_produk', $key)
			->get('produk')
			->result();
	}

	function stok_list()
	{
		return $this->db->count_all_results('produk');
	}

	function halaman($number, $offset)
	{
		return $this->db->select('id_produk as id, nama_produk as nama_produk, harga, range_harga')
			->get('produk', $number, $offset)
			->result();
	}

	public function getProductById($id)
	{
		$this->db->where('id_produk', $id);
		$query = $this->db->get('produk');
		return $query->row();
	}

	function cart($id)
	{
		return $this->db->select('id_produk as id, nama_produk as nama_produk, harga')
			->where('id_produk', $id)
			->get('produk')
			->row();
	}

	function tambah_trf($payment)
	{
		$this->db->insert('detail_penjualan', $payment);
	}

	function get_byr($id)
	{
		return $this->db->where('id_byr', $id)->get('pembayaran')->row();
	}

	function get_nourut()
	{
		return $this->db->select('max(id) as nomor')
			->from('detail_penjualan')->get()->result();
	}

	function get_id($id)
	{
		return $this->db->select('id')->where('no_trf', $id)->get('detail_penjualan')->row_array();
	}

	function tambah_pjl($penjualan)
	{
		$this->db->insert_batch('penjualan', $penjualan);
		return $this->db->affected_rows();
	}

	function pengurangan_stok($pjl)
	{
		$this->db->update_batch('produk', $pjl, 'id_produk');
		return $this->db->affected_rows();
	}

	function get_detail_modal($id)
	{
		return $this->db->where('id_produk', $id)
			->get('produk')
			->row();
	}

	function total_barang($id)
	{
		return $this->db->select('stok')
			->where('id_produk', $id)
			->get('produk');
	}

	function filter_barang($kategori, $number, $offset)
	{
		if ($kategori != '') {
			return $this->db->where('produk.id_kategori', $kategori)
				->select('id_produk as id, nama_produk as nama_produk, harga, stok, foto')
				->get('produk', $number, $offset)
				->result();
		} else {
			return $this->db->select('id_produk as id, nama_produk as nama_produk, harga, stok, foto')
				->get('produk', $number, $offset)
				->result();
		}
	}

	// Add the save_transaction method
	public function save_transaction($data)
	{
		try {
			$this->db->insert('detail_penjualan', $data); // Insert into detail_penjualan
			return $this->db->insert_id(); // Return the inserted transaction ID
		} catch (Exception $e) {
			log_message('error', 'Error occurred while saving transaction: ' . $e->getMessage());
			return false;
		}
	}

	public function save_penjualan($data)
	{
		try {
			$this->db->insert('penjualan', $data); // Insert into penjualan
			return $this->db->insert_id(); // Return the inserted penjualan ID
		} catch (Exception $e) {
			log_message('error', 'Error occurred while saving penjualan: ' . $e->getMessage());
			return false;
		}
	}

	function cek_transaksi($id)
	{
		return $this->db->select('detail_penjualan.*, penjualan.*, produk.*, pembayaran.*, bank.*')
			->from('detail_penjualan')
			->join('penjualan', 'penjualan.no_trf = detail_penjualan.no_trf', 'left')
			->join('produk', 'produk.id_produk = penjualan.id_produk', 'left')
			->join('pembayaran', 'pembayaran.id_byr = detail_penjualan.id_pembayaran', 'inner')
			->join('bank', 'bank.id = detail_penjualan.id_bank', 'left')
			->where('detail_penjualan.id', $id)
			->get()
			->result();
	}
}