<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pembayaran</title>
	<!-- Include jQuery and other necessary scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
	<script src="<?php echo base_url() ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css">
	<!-- Include wysihtml5 dependencies before your custom script -->
	<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>">
		
	</script>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/app/css/style.css">

	<link rel="stylesheet" href="http://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/css/msdropdown/dd.css">
	<script src="http://www.marghoobsuleman.com/mywork/jcomponents/image-dropdown/samples/js/msdropdown/jquery.dd.min.js"></script>
	<style>
		/* Improved item-list styling */
		.item-list .pro-1 {
			border: 1px solid #ddd;
			margin-bottom: 15px;
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
			transition: all 0.3s ease;
			text-align: center;
			background-color: #fff;
			padding: 20px;
		}

		.item-list .pro-1:hover {
			transform: translateY(-5px);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
		}

		.item-list .pro-1 .header {
			background-color: #28a745;
			color: #fff;
			padding: 10px 0;
			font-size: 18px;
			font-weight: bold;
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
		}

		.item-list .pro-1 .offer-img {
			display: block;
			height: 150px;
			background-size: cover;
			background-position: center;
			margin: 15px 0;
		}

		.item-list .pro-1 .mid-1 .women h6 {
			color: #333;
			font-size: 16px;
			font-weight: 600;
			margin: 10px 0;
		}

		.item-list .pro-1 .mid-2 p {
			color: #ff6f61;
			font-size: 14px;
			font-weight: 700;
			margin: 10px 0;
		}

		/* Improved checkbox styling */
		.custom-checkbox {
			position: relative;
			display: flex;
			align-items: center;
		}

		.custom-checkbox input[type="checkbox"] {
			appearance: none;
			width: 20px;
			height: 20px;
			border: 2px solid #ddd;
			border-radius: 4px;
			outline: none;
			transition: all 0.3s ease;
			cursor: pointer;
			margin-right: 10px;
		}

		.custom-checkbox input[type="checkbox"]:checked {
			background-color: #ff6f61;
			border-color: #ff6f61;
		}

		.custom-checkbox input[type="checkbox"]:checked::after {
			content: '\2714';
			color: #fff;
			position: absolute;
			top: 2px;
			left: 5px;
			font-size: 14px;
		}

		.custom-checkbox label {
			margin: 0;
			font-size: 14px;
			font-weight: 600;
		}

		.add a {
			background-color: #ff6f61;
			color: #fff;
			padding: 10px 80px;
			font-size: 16px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		.add a:hover {
			color: #fff;
		}

		.qty-input {
			width: 60px;
		}
	</style>
</head>

<body>
	<section class="content">
	
		<div class="row">
			<div class="col-md-6">
				<div class="box box-warning kasir">
					<div class="box-header with-border">
						<h3 class="box-title">Pembayaran</h3>
						<div class="box-tools pull-right">
							<span><i class="fa fa-shopping-cart"></i></span>
						</div>
					</div>
					<div class="box-body">
						<div style="width: 470px;" class="cart">
							<div id="pos">
								<div class="well well-sm" id="leftdiv">
									<div id="cart">
										<table border="1" class="table table-striped list-table" style="margin:0;">
											<thead>
												<tr class="info">
													<th style="width: 30%;text-align:left;">Nama Produk</th>
													<th style="width: 30%;text-align:center;">Harga</th>
													<th style="width: 10%;text-align:center;">Qty</th>
													<th style="width: 30%;text-align:center;">Subtotal</th>
													<th style="width: 20px;" class="satu absorbing-column"><i class="fa fa-trash-o"></i></th>
												</tr>
											</thead>
											<tbody id="cart-contents">
												<!-- Cart contents will be injected here -->
											</tbody>
										</table>
									</div>

									<div style="clear:both;"></div>
									<table id="totaltbl" class="table table-condensed totals" style="margin-bottom:10px;">
										<tr class="info">
											<td width="25%"></td>
											<td class="text-center" style="padding-right:10px;"><span id="count"><?= $this->cart->total_items(); ?></span></td>
											<td width="25%" style="font-weight:bold;">Subtotal</td>
											<td class="text-right" style="font-weight:bold;" colspan="2"><span id="total">Rp.<?= $this->fungsi->rupiah($this->cart->total()); ?></span>
											</td>
										</tr>
										<tr>
											<td colspan="3" class="text-right" style="font-weight:bold;">Total</td>
											<td class="text-right" style="font-weight:bold;" colspan="2">
												<span id="custom_total">Rp.<?= $this->fungsi->rupiah($this->cart->total()); ?></span>
											</td>
										</tr>
									</table>
								</div>
								<div id="botbuttons" class="col-xs-12 text-center">
									<div class="row">
										<div class="col-xs-6" style="padding: 0;">
											<div class="btn-group-vertical btn-block">
												<a href="<?php echo base_url() ?>index.php/penjualan/cancel" class="btn btn-danger btn-block btn-flat" id="reset">Cancel</a>
											</div>
										</div>
										<div class="col-xs-6" style="padding: 0;">
											<a href="#" onclick="payment()" class="btn btn-success btn-block btn-flat" id="pembayaran">Pembayaran</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title" id="ReciverName_txt">List Produk</h3>
						<div class="col-md-3 pull-right">
							<a href="#" onclick="sort()" class="btn btn-default btn-sm toggle_form pull-right">Tampilkan/Sembunyikan Filter</a>
						</div>
						<div class="box-tools pull-right">
							<span data-toggle="tooltip">
								<i class="fa fa-cubes"></i>
							</span>
						</div>
					</div>
					<div class="contents" id="right-col">
						<div class="box-body" style="height:670px;overflow-y: scroll;">
							<div class="listitem with-border">
								<div id="sort" class="sort-section">
									<?php echo form_open('penjualan/store'); ?>
									<div class="form-group row">
										<div class="col-sm-7">
											<div class="input-group">
												<select class="form-control" name="produk" id="produk">
													<option value="">Pilih Semua</option>
													<?php foreach ($produk as $k) : ?>
														<option value="<?= $k->id_produk ?>"><?= $k->nama_produk ?></option>
													<?php endforeach; ?>
												</select>
												<span class="input-group-addon">
													<span class="fa fa-list"></span>
												</span>
											</div>
										</div>
										<div class="col-sm-3">
											<button type="submit" name="filter" class="btn btn-primary btn-block">Filter</button>
										</div>
									</div>
									<?php echo form_close(); ?>
								</div>
								<div id="item-list" class="item-list">
									<div class="items">
										<?php foreach ($result as $row) { ?>
											<div class="col-md-6 pro-1">
												<div class="header">Produk</div>
												<a href="#" onclick="detailCart('<?php echo $row->id_produk ?>')" class="offer-img">
													<!-- Include your product image here -->
												</a>
												<div class="mid-1">
													<div class="women">
														<h6 align="center"><a href="single.html"><?php echo $row->nama_produk; ?></a></h6>
													</div>
													<div class="mid-2">
														<p align="center"><?php echo number_format($row->harga).'-'.number_format($row->harga_akhir); ?></p>
													</div>
													<div class="add">
														<p align="center">
															<a href="#" onclick="addToCart('<?php echo $row->id_produk; ?>')" type="button" class="btn btn-danger btn-xs my-cart-btn my-cart-b">Add</a>
														</p>
													</div>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="page">
						<?php if (!isset($_POST['filter'])) {
							echo $halaman;
						} ?>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modal for Payment -->
	<div class="modal fade" id="modalpayment" role="dialog" style="min-width: 80%;">
		<div class="modal-dialog" style="min-width: 50%;">
			<div class="modal-content">
				<div id="datapayment">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
						<h4 class="modal-title" id="payModalLabel">Payment</h4>
					</div>
					<div class="modal-body">
						<form action="<?= base_url('penjualan/transaksi'); ?>" method="POST" name="frm_byr" onsubmit="return confirm('Pastikan sudah terjadi pembayaran!');">
							<div class="form-group">
								<div class="row">
									<div class="col-xs-12">
										<div>
											<table id="modaltab" class="table table-bordered table-condensed" style="margin-bottom: 0;">
												<tr class="table-secondary">
													<td id="mdl" width="25%" style="border-right-color: #FFF !important;">
														Total Produk</td>
													<td id="mdl" width="25%" class="text-center">
														<span id="item_count">0</span>
													</td>
													<td id="mdl" width="25%" style="border-right-color: #FFF !important;">
														Grand Total</td>
													<td id="mdl" width="25%" class="text-center" align="left">
														<input type="hidden" id="custom_total_hidden" value="0">
														<input type="hidden" name="totalpure" id="totalpure" value="0" class="form-control kb-text">
														<input type="hidden" name="grand_total" id="grand_total" value="0" class="form-control kb-text">
														<input type="hidden" id="custom_total_hidden" value="0">
														<span>Rp. <input readonly type="text" style="width:100px" id="total_input" name="grand_total_display"  required=""></span>
													</td>
												</tr>
												<tr>
													<td id="mdl" style="border-right-color: #FFF !important;">Diskon
													</td>
													<td id="mdl" class="text-center">
														<input type="number" name="diskon" id="diskon" max="100" min="0" value="0" required oninput="updateGrandTotal()">
														<span>%</span>
													<!-- </td>
													<td id="mdl" style="border-right-color: #FFF !important;">Kembalian
													</td> -->
													<td id="mdl" class="text-right" style="display:none">
														<span>Rp.<input readonly type="number" id="kembalian" name="kembalian" value="0" required></span>
													</td>
												</tr>
											</table>
											<div class="clearfix"></div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<!-- <div class="form-group">
													<label for="note"><strong>BAYAR (Rp)</strong></label>
													<input type="number" placeholder="Pembayaran" name="bayar" class="form-control" id="bayar" required="" onblur="updateKembalian()">
												</div> -->
												<div class="form-group">
                            <label for="id_konsumen">Nama Pelanggan</label>
                            <input type="text" name="pelanggan" class="form-control" placeholder="Nama Pelanggan">
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="no_handphone">No Handphone</label>
                            <input type="text" name="no_handphone" class="form-control" placeholder="No Handphone">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
                        </div>
                           
												<div class="form-group">
													<label for="note">Catatan</label>
													<textarea name="note" placeholder="Catatan untuk transaksi" id="note" class="pa form-control kb-text"></textarea>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<div class="form-group">
													<label for="payment">Metode Pembayaran</label>
													<select id="payment" name="metode" class="form-control" style="width:100%;" onchange="toggleRek()">
														<option value="1">Cash</option>
														<option value="2">Transfer</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row" id="rek" style="display: none;">
											<div class="col-xs-4">
												<div class="form-group">
													<label for="note">No. Rek</label>
													<input type="text" width="100px" id="no_rek" name="no_rek" class="form-control kb-text">
												</div>
											</div>
											<div class="col-xs-5">
												<div class="form-group">
													<label for="note">Bank</label>
													<div id="byjson"></div>
												</div>
											</div>
											<div class="col-xs-12">
												<div class="form-group">
													<label for="note">Atas Nama(A/N)</label>
													<input type="text" name="atas_nama" class="form-control kb-text">
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
											<button class="btn btn-primary" id="submit-sale">Submit</button>
										</div>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="myModal2" role="dialog" style="min-width: 100%">
		<div class="modal-dialog">
			<div id="barang"></div>
		</div>
	</div>

	<!-- Include your JavaScript functions here -->
	<script src="<?php echo base_url() ?>assets/plugins/zoomto/jquery.zoomtoo.js"></script>
	<script>
		$(function() {
			$("#picture-frame").zoomToo({
				magnify: 1
			});
		});

		function addToCart(productId) {
			console.log("Adding product to cart with ID:", productId);
			$.ajax({
				url: '<?php echo base_url('penjualan/tambah_produk'); ?>/' + productId + '/1',
				type: 'POST',
				dataType: 'json',
				success: function(response) {
					if (response.status === 'success') {
						updateCart();
					} else {
						alert('Error adding product to cart: ' + response.message);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.error('AJAX error:', textStatus, errorThrown);
					alert('Error adding product to cart');
				}
			});
		}


		function updateCart() {
			$.ajax({
				url: "<?php echo base_url('penjualan/get_cart'); ?>",
				type: "GET",
				dataType: 'json',
				success: function(response) {
					if (response.status === 'success') {
						let cartContents = '';
						$.each(response.cart_contents, function(index, item) {
							const subtotal = (item.qty * item.price);
							cartContents += '<tr>' +
								'<td data-product-id="' + item.id + '">' + item.name + '</td>' +
								'<td class="text-center"><input type="number" min="1" class="price-input" value="' +
								item.price + '" onblur="updateSubtotal(this, \'' + item.rowid + '\', \'price\')"></td>' +
								'<td class="text-center"><input type="number" min="1" class="qty-input" value="' +
								item.qty + '" oninput="updateSubtotal(this, \'' + item.rowid + '\', \'qty\')"></td>' +
								'<td class="text-center subtotal-cell">Rp.' + subtotal + '</td>' +
								'<td class="text-center"><button onclick="removeFromCart(\'' + item.rowid + '\')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></td>' +
								'</tr>';
						});

						$('#cart-contents').html(cartContents);
						$('#count').text(response.total_items);
						$('#total').text('Rp.' + response.total);
						calculateCustomTotal();
					} else {
						alert('Error fetching cart data');
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Error fetching cart data');
				}
			});
		}




		// Attach event listeners to quantity inputs and custom option checkbox
		document.querySelectorAll('.qty-input').forEach(input => {
			input.addEventListener('input', function() {
				updateSubtotal(this, this.closest('tr').dataset.rowid);
			});
		});

		document.getElementById('custom_option').addEventListener('change', function() {
			updateSubtotal();
		});

		// Initial calculation on document ready
		$(document).ready(function() {
			updateSubtotal();
		});

		// Ensure this recalculates whenever the quantity inputs or custom option changes


		// Event handler for input changes
		// $('#bayar').on('input', function() {
		// 	calculateCustomTotal();
		// });

		// Initial calculation on document ready
		$(document).ready(function() {
			calculateCustomTotal();
		});

		function calculateCustomTotal() {
			let total = parseFloat($('#total').text().replace('Rp.', '').replace(/,/g, '')) || 0;
			const customOption = $('#custom_option').is(':checked');
			const customCharge = customOption ? total * 0.4 : 0;
			const customTotal = customOption ? total + customCharge : total;


			// Display the custom total and charge percentage
			$('#custom_total').text('Rp.' + customTotal.toFixed(2));

			$('#custom_charge_percent').text(customOption ? '40%' : '0%');
		}


		function updateCartSummary() {
			let totalItems = 0;
			let subtotal = 0;

			document.querySelectorAll('#cart-contents tr').forEach(row => {
				const quantity = parseInt(row.querySelector('.qty-input').value);
				const price = parseFloat(row.querySelector('td:nth-child(2)').innerText.replace(/[^0-9.-]+/g, ""));
				const rowSubtotal = price * quantity;
				totalItems += quantity;
				subtotal += rowSubtotal;

				row.querySelector('.subtotal-cell').innerText = 'Rp.' + subtotal.toLocaleString('id-ID');
			});


			document.getElementById('count').innerText = totalItems;
			document.getElementById('total').innerText = 'Rp ' + subtotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ".");

			const customOption = $('#custom_option').is(':checked');
			const customCharge = customOption ? subtotal * 0.4 : 0;
			const customTotal = customOption ? subtotal + customCharge : subtotal;

			$('#custom_charge_percent').text(customOption ? '40%' : '0%');
			$('#custom_total').text('Rp ' + customTotal.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, "."));
		}



		function removeFromCart(rowid) {
			$.ajax({
				url: '<?php echo base_url('penjualan/hapus_cart'); ?>/' + rowid,
				type: 'POST',
				success: function() {
					updateCart();
				},
				error: function() {
					alert('Error removing product from cart');
				}
			});
		}

		function startCalculate() {
			interval = setInterval("Calculate()", 1);
		}

		function Calculate() {
			let a = <?= $this->cart->total(); ?>;
			let c = document.frm_byr.diskon.value;
			let d = document.frm_byr.bayar.value;
			let e = 100;
			let f = (a / e * c);
			let g = (a - f);
			let h = (d - g);
			document.frm_byr.total.value = g;
			document.frm_byr.kembalian.value = h;
		}

		function stopCalc() {
			clearInterval(interval);
		}

		function updateTotalWithDiscount() {
			let total = parseFloat(document.getElementById('total_input').value) || 0;
			let diskon = parseFloat(document.getElementById('diskon').value) || 0;
			let grandTotal = total - (total * diskon / 100);
			document.getElementById('grand_total').value = grandTotal;
			document.getElementById('custom_total').innerText = 'Rp.' + grandTotal.toFixed(2);
			updateChange();
		}

		document.getElementById('diskon').addEventListener('input', updateTotalWithDiscount);

		// Initial calculation on document ready
		$(document).ready(function() {
			updateTotalWithDiscount();
		});

		function updateChange() {
			let total = parseFloat(document.getElementById('grand_total').value);
			let bayar = parseFloat(document.getElementById('bayar').value);
			let kembalian = bayar - total;
			document.getElementById('kembalian').value = kembalian.toFixed(2); // Update the kembalian field
		}

		document.getElementById('bayar').addEventListener('input', updateChange);

		function detailCart(id) {
			var url = "<?= base_url() ?>penjualan/detail_modal/" + id;
			$.ajax({
				url: url,
				type: "GET",
				data: {
					id: id
				},
				success: function(data) {
					$('#barang').html(data);
					$('#myModal2').modal("show");
				},
				error: function(jqXHR, textStatus, errorThrown) {
					alert('Error adding / update data');
				}
			});
		}

		function showResult(str) {
			if (str.length == 0) {
				document.getElementById("hasilcari").innerHTML = "";
				document.getElementById("hasilcari").style.border = "0px";
				return;
			}
			if (window.XMLHttpRequest) {
				xmlhttp = new XMLHttpRequest();
			} else {
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("hasilcari").innerHTML = this.responseText;
					document.getElementById("hasilcari").style.border = "1px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET", "<?= base_url(); ?>penjualan/caribarang?q=" + str, true);
			xmlhttp.send();
		}

		$(document).ready(function() {
			createByJson();
		});

		// Your createByJson function
		function createByJson() {
			console.log("Fungsi createByJson dipanggil.");
			let jsonData = [{
					description: 'Pilih Metode Transfer Pembayaran',
					value: '',
					text: 'Bank Transfer'
				},
				{
					image: '../assets/dist/img/bank/mandiri.png',
					description: '',
					value: '1',
					text: 'Mandiri'
				},
				{
					image: '../assets/dist/img/bank/bni.png',
					description: '',
					value: '2',
					text: 'BNI'
				},
				{
					image: '../assets/dist/img/bank/bca.png',
					description: '',
					value: '3',
					text: 'BCA'
				},
				{
					image: '../assets/dist/img/bank/bri.png',
					description: '',
					value: '4',
					text: 'BRI'
				},
				{
					image: '../assets/dist/img/bank/niaga.png',
					description: '',
					value: '5',
					text: 'CIMB Niaga'
				}
			];

			console.log(jsonData);
			try {
				let jsn = $("#byjson").msDropDown({
					byJson: {
						data: jsonData,
						name: 'payments'
					}
				}).data("dd");

				console.log(jsn);
			} catch (error) {
				console.error("Error initializing msDropDown plugin:", error);
			}
		}

		function checkMinimumOrder() {
			const cartContents = $('#cart-contents tr');
			let hasMinOrderProduct = false;
			let minOrderQty = 1
			let currentQty = 0;

			cartContents.each(function() {
				const row = $(this);
				const productId = row.find('td').data('product-id');
				const qty = parseInt(row.find('.qty-input').val(), 10);

				if (productId === 3) {
					hasMinOrderProduct = true;
					currentQty += qty;
				}
			});

			if (hasMinOrderProduct && currentQty < minOrderQty) {
				return false;
			}

			return true;
		}


		function updateSubtotal(inputElement, rowid, type) {
			let totalItems = 0;
			let total = 0;

			document.querySelectorAll('#cart-contents tr').forEach(row => {
				const price = parseFloat(row.querySelector('.price-input').value);
				const quantity = parseInt(row.querySelector('.qty-input').value);
				const subtotal = price * quantity;

				totalItems += quantity;
				total += subtotal;

				row.querySelector('.subtotal-cell').innerText = subtotal;
			});

			document.getElementById('count').innerText = totalItems;
			document.getElementById('total').innerText = 'Rp ' + total.toLocaleString('id-ID');

			document.getElementById('custom_total').innerText = total;
			document.getElementById('custom_total_hidden').value = total;

			document.getElementById('totalpure').value = total;
			document.getElementById('grand_total').value = total;
			document.getElementById('total_input').value = total;
			
			if (inputElement && rowid) {
				const data = { rowid: rowid };
				if (type === 'qty') {
					data.qty = inputElement.value;
				} else if (type === 'price') {
					data.price = inputElement.value;
					data.product_id = $(inputElement).closest('tr').find('td[data-product-id]').data('product-id');
				}

				$.ajax({
					url: '<?php echo base_url('penjualan/update_cart'); ?>',
					type: 'POST',
					data: data,
					dataType: 'json',
					success: function(response) {
						if (response.status === 'success') {
							console.log('Cart updated successfully');
						} else {
							console.error('Error updating cart:', response.message);
							alert(response.message);
							updateCart();
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.error('AJAX error:', textStatus, errorThrown);
						alert('Error updating cart');
						updateCart();
					}
				});
			}
		}
		$(document).ready(function() {
			$('#modalpayment').on('show.bs.modal', function () {
				createByJson(); 
			});
		});

		function payment() {
			console.log(createByJson());
			let cartContents = $('#cart-contents tr');
			if (cartContents.length == 0) {
				alert('Cart tidak boleh kosong!');
				return;
			}

			if (checkMinimumOrder()) {
				updateSubtotal(); 

				const customTotal = document.getElementById('custom_total').innerText.replace('Rp ', '').replace(/,/g, '');
				const itemCount = document.getElementById('count').innerText;
				

				document.getElementById('total_input').value = customTotal; 
				document.getElementById('grand_total').value = customTotal; 
				document.getElementById('item_count').innerText = itemCount;

				document.getElementById('kembalian').value = 0;
				document.getElementById('diskon').value = 0;

				$.ajax({
					url: '<?php echo base_url('penjualan/get_cart'); ?>',
					type: 'GET',
					dataType: 'json',
					success: function(response) {
						if (response.status === 'success') {
							$('#modalpayment').modal('show');
							createByJson();

						} else {
							alert('Error fetching cart data');
						}
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.error('AJAX error:', textStatus, errorThrown);
						alert('Error fetching cart data');
					}
				});
			} else {
				alert('Minimum order belum tercapai!');
			}
			
		}

		function updateGrandTotal() {
			const totalInput = parseInt(document.getElementById('custom_total_hidden').value.replace('Rp ', '').replace(/,/g, ''), 10);
			const diskon = parseInt(document.getElementById('diskon').value, 10) || 0;

			const grandTotal = totalInput - (totalInput * (diskon / 100));

			document.getElementById('grand_total').value = grandTotal;
			document.getElementById('total_input').value = grandTotal;
		}


		// function updateKembalian() {
		// 	const bayar = parseInt(document.getElementById('bayar').value.replace(/,/g, ''), 10) || 0;
		// 	const grandTotal = parseInt(document.getElementById('grand_total').value.replace(/,/g, ''), 10) || 0;

		// 	const kembalian = bayar - grandTotal;

		// 	document.getElementById('kembalian').value = kembalian;
		// }
		


		function toggleRek() {
			var paymentSelect = document.getElementById("payment");
			var rekDiv = document.getElementById("rek");

			if (paymentSelect.value === "2") { // Jika jenis pembayarannya adalah transfer
				rekDiv.style.display = "block"; // Tampilkan div "rek"
			} else {
				rekDiv.style.display = "none"; // Sembunyikan div "rek"
			}
		}
		$(function() {
			$('#rek').hide();
			$('#payment').change(function() {
				if ($('#payment').val() == '2') {
					$('#rek').show();
					createByJson();
				} else {
					$('#rek').hide();
				}
			});
		});
	</script>
</body>

</html>