<?php

class Penjualan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		chek_session();
		$this->load->model('Model_produk');
		$this->load->model('Model_penjualan');
		$this->load->library('cart');
	}



	public function store()
	{
		if (isset($_POST['filter'])) {
			$key = $this->input->post('produk');
			$total = $this->Model_produk->count_filtered_products($key);
			$this->load->library('pagination');
			$config['base_url'] = base_url('penjualan/store/');
			$config['total_rows'] = $total;
			$config['per_page'] = 8;
			$config = $this->pagination_config($config);
			$this->pagination->initialize($config);
			$from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data = array(
				'halaman' => $this->pagination->create_links(),
				'result' => $this->Model_produk->filter_products($key, $config['per_page'], $from),
				'produk' => $this->Model_produk->tampil_data()->result()
			);
			$this->template->load('template/template', 'Penjualan/penjualan', $data);
		} else {
			$total = $this->Model_produk->tampil_data()->num_rows();
			$this->load->library('pagination');
			$config['base_url'] = base_url('penjualan/store/');
			$config['per_page'] = 8;
			$config['total_rows'] = $total;
			$config = $this->pagination_config($config);
			$this->pagination->initialize($config);
			$from = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$data = array(
				'halaman' => $this->pagination->create_links(),
				'result' => $this->Model_produk->tampil_data($config['per_page'], $from)->result(),
				'produk' => $this->Model_produk->tampil_data()->result()
			);

			$this->template->load('template/template', 'Penjualan/penjualan', $data);
			$this->load->view('template/datatables');
		}
	}

	private function pagination_config($config)
	{
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Prev';
		$config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close'] = '</ul></nav></div>';
		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></li>';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] = '</span>Next</li>';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] = '</span></li>';
		return $config;
	}


	public function tambah_produk($id, $qty)
	{
		try {
			// Log the received product ID and quantity
			log_message('debug', 'Adding product to cart. Product ID: ' . $id . ', Quantity: ' . $qty);

			// Retrieve the product details from the model
			$produk = $this->Model_produk->getProductById($id);

			if ($produk) {
				$data = array(
					'id'      => $produk->id_produk,
					'name'    => $produk->nama_produk,
					'qty'     => $qty,
					'price'   => $produk->harga,
					'max_price' => $produk->harga_akhir
				);

				// Insert the product into the cart
				$this->cart->insert($data);

				// Log the successful addition of the product
				log_message('debug', 'Product added to cart successfully. Product ID: ' . $id);

				// Return a JSON response
				$this->output->set_content_type('application/json')
					->set_output(json_encode(['status' => 'success', 'message' => 'Product added to cart']));
			} else {
				// Log if the product is not found
				log_message('error', 'Product not found. Product ID: ' . $id);

				// Return an error response
				$this->output->set_content_type('application/json')
					->set_output(json_encode(['status' => 'error', 'message' => 'Product not found']));
			}
		} catch (Exception $e) {
			// Log any exception that occurs
			log_message('error', 'Exception occurred while adding product to cart: ' . $e->getMessage());

			// Return an error response
			$this->output->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'An error occurred while adding the product to the cart']));
		}
	}

	public function get_cart()
	{
		try {
			// Get the cart contents
			$cart_contents = $this->cart->contents();
			$total_items = $this->cart->total_items();
			$total = $this->cart->total();

			// Log the total for debugging
			log_message('debug', 'Cart Total: ' . $total);

			// Return the cart contents as a JSON response
			$this->output->set_content_type('application/json')
				->set_output(json_encode([
					'status' => 'success',
					'cart_contents' => $cart_contents,
					'total_items' => $total_items,
					'total' => $total
				]));
		} catch (Exception $e) {
			// Log any exception that occurs
			log_message('error', 'Exception occurred while retrieving cart contents: ' . $e->getMessage());

			// Return an error response
			$this->output->set_content_type('application/json')
				->set_output(json_encode(['status' => 'error', 'message' => 'An error occurred while retrieving the cart contents']));
		}
	}

	public function lihat_barang($id)
	{
		$query = $this->db->select('id_produk as id, nama_produk as nama_produk, harga, range_harga, jumlah')
			->where('id_produk', $id)
			->get('produk');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return null;
		}
	}

	function caribarang()
	{
		$key = $this->input->get('q');
		$data = $this->Model_penjualan->hasilcari($key);
		foreach ($data as $result) {
			echo '<a href="' . base_url() . 'index.php/penjualan/tambah_produk/' . $result->id_produk . '/1">' . $result->nama_produk . '</a><br />';
		}
	}


	function hapus_cart($row)
	{
		$data = array(
			'rowid' => $row,
			'qty'   => 0,
		);
		$this->cart->update($data);
		redirect(base_url('index.php/penjualan'));
	}

	function cancel()
	{
		$this->cart->destroy();
		redirect(base_url('index.php/penjualan'));
	}


	public function update_cart() {
        $this->load->model('Model_produk');

        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        $product_id = $this->input->post('product_id');

        // Ensure rowid and either qty or price are provided
        if ($rowid && ($qty || $price)) {
            $data = array('rowid' => $rowid);

            if ($qty) {
                $data['qty'] = $qty;
            }

            if ($price) {
                // Fetch product details to validate price
                $product = $this->Model_produk->get_product($product_id);

                if ($price < $product->harga || $price > $product->harga_akhir) {
                    echo json_encode(['status' => 'error', 'message' => 'Price is out of range']);
                    return;
                }

                $data['price'] = $price;
            }

            if ($this->cart->update($data)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update cart']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        }
    }

	function formatNbr($nbr)
	{
		if ($nbr == 0 || $nbr == NULL)
			return "001";
		else if ($nbr < 10)
			return "00" . $nbr;
		elseif ($nbr >= 10 && $nbr < 100)
			return "0" . $nbr;
		else
			return strval($nbr);
	}

// 	public function transaksi()
// {
//     if ($this->input->server('REQUEST_METHOD') === 'POST') {
//         $no_trf = 'T' . date('YmdHis'); // Generate a transaction number
//         $tgl_trf = date('Y-m-d'); // Current date
//         $jam_trf = date('H:i:s'); // Current time

//         $transaksi_data = array(
//             'no_trf' => $no_trf,
//             'nama_pelanggan' => $this->input->post('pelanggan', true),
//             'totalpure' => $this->input->post('grand_total', true), // Assuming grand_total is the final amount after any calculations
//             'tgl_trf' => $tgl_trf,
//             'jam_trf' => $jam_trf,
//             'id_pembayaran' => $this->input->post('metode'),
//             'operator' => $this->session->userdata('username'),
//         );

//         // Save the transaction
//         $transaksi_id = $this->Model_penjualan->save_transaction($transaksi_data);

//         if ($transaksi_id) {
//             $this->cart->destroy();
//             redirect('penjualan/struk/' . $transaksi_id);
//         } else {
//             // Handle error if saving transaction fails
//             $this->session->set_flashdata('error', 'Transaction failed to save.');
//             redirect('penjualan');
//         }
//     }
// }


public function transaksi()
{
	if ($this->input->server('REQUEST_METHOD') === 'POST') {
		$no_trf = 'T' . date('YmdHis'); // Generate a transaction number
		$tgl_trf = date('Y-m-d'); // Current date
		$jam_trf = date('H:i:s'); // Current time

		// Fetch and validate totalpure


		$transaksi_data = array(
			
			'no_trf' => $no_trf,
			'nama_pelanggan' => $this->input->post('pelanggan', true),
			'no_handphone' => $this->input->post('no_handphone', true),
			'alamat' => $this->input->post('alamat', true),
			'totalpure' => $this->input->post('totalpure', true),
			'grand_total' => $this->input->post('grand_total', true),
			'diskon' => $this->input->post('diskon', true),
			// 'bayar' => $this->input->post('grand_total', true),
			// 'kembalian' => $this->input->post('kembalian', true),
			'catatan' => $this->input->post('note', true),
			'tgl_trf' => $tgl_trf,
			'jam_trf' => $jam_trf,
			'id_pembayaran' => $this->input->post('metode'),
			'no_rek' => $this->input->post('no_rek', true),
			'atas_nama' => $this->input->post('atas_nama', true),
			'id_bank' => $this->input->post('payments'),
			'operator' => $this->session->userdata('username'),
			'custom' => $this->input->post('custom_option') ? 'Custom Order' : 'Net'
			
			
		);

		// Save the transaction
		$transaksi_id = $this->Model_penjualan->save_transaction($transaksi_data);
		$totalpure = $this->input->post('grand_total');

		if ($transaksi_id) {
			$cart_contents = $this->cart->contents();
			foreach ($cart_contents as $item) {
				$penjualan_data = array(
					'no_trf' => $no_trf,
					'id_produk' => $item['id'],
					'jumlah' => $item['qty'],
					'harga_barang' => $item['price'],
					'sub_total' => $item['subtotal'],
					'total' => $totalpure,
				);
				$this->Model_penjualan->save_penjualan($penjualan_data);
			}
			$this->cart->destroy();
			redirect('penjualan/struk/' . $transaksi_id);
		} else {
			// Handle error if saving transaction fails
			$this->session->set_flashdata('error', 'Transaction failed to save.');
			redirect('penjualan');
		}
	}
}



// function struk($id)
// {
//     $cek = $this->Model_penjualan->cek_transaksi($id); //print_r($cek);die();
//     $data = array(
//         'tanggal' => $cek[0]->tgl_trf,
//         'jam' => $cek[0]->jam_trf,
//         'nota' => $cek[0]->no_trf,
//         'operator' => $cek[0]->operator,
//         'pelanggan' => $cek[0]->nama_pelanggan,
//         'total' => $cek[0]->totalpure,
//         'grand_total' => $cek[0]->grand_total,
//         'result' => $cek,
//         'metode' => $cek[0]->metode,
//     );
//     $this->template->load('template/template', 'penjualan/struk', $data);
// }

function struk($id)
	{
		$cek = $this->Model_penjualan->cek_transaksi($this->uri->segment(3));
		$data = array(
			'tanggal' => $cek[0]->tgl_trf,
			'jam' => $cek[0]->jam_trf,
			'nota' => $cek[0]->no_trf,
			'operator' => $cek[0]->operator,
			'pelanggan' => $cek[0]->nama_pelanggan,
			'no_handphone' => $cek[0]->no_handphone,
			'alamat' => $cek[0]->alamat,
			'total' => $cek[0]->totalpure,
			'diskon' => $cek[0]->diskon,
			'grand_total' => $cek[0]->grand_total,
			'result' => $cek,
			'metode' => $cek[0]->metode,
			// 'bayar' => $cek[0]->bayar,
			// 'kembalian' => $cek[0]->kembalian,
			'rekening' => $cek[0]->no_rek,
			'bank' => $cek[0]->nama_bank,
			'atasnama' => $cek[0]->atas_nama,
		);
		$this->template->load('template/template', 'penjualan/struk', $data);
	}
	function detail_modal($id)
	{
		$id = $this->input->get('id');
		$data['detail'] = $this->Model_penjualan->get_detail_modal($id);
		$this->load->view('penjualan/modal_detail', $data);
	}
}
