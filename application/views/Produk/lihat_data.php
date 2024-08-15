<!-- Product Table -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class='box-header with-border'>
					<h3 class='box-title'>Data Produk</h3>
					<div class="pull-right">
						<?php echo anchor('produk/post', 'Tambah data', array('class' => 'btn btn-success')) ?>
					</div>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Harga Awal</th>
								<th>Harga Akhir</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 0;
							foreach ($record as $r) { ?>
								<tr>
									<td><?php echo ++$no; ?></td>
									<td><?php echo $r->nama_produk; ?></td>
									<td>Rp.<?php echo isset($r->harga) ? number_format($r->harga) : ''; ?></td>
									<td>Rp.<?php echo isset($r->harga_akhir) ? number_format($r->harga_akhir) : ''; ?></td>
									<td>
										<?php echo anchor(site_url('produk/edit/' . $r->id_produk), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning')); ?>
										<?php echo '&nbsp'; ?>
										<?php echo anchor(site_url('produk/hapus/' . $r->id_produk), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger"'); ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(document).ready(function() {
		$('#myTable').DataTable({
			dom: 'Blfrtip',
			buttons: [{
					extend: 'csvHtml5',
					exportOptions: {
						columns: [0, 1, 2, 3, 4]
					}
				},
				{
					extend: 'excelHtml5',
					title: 'DATAPRODUK',
					exportOptions: {
						columns: [0, 1, 2, 3, 4]
					}
				},
				{
					extend: 'copyHtml5',
					title: 'Data Produk',
					exportOptions: {
						columns: [0, 1, 2, 3, 4]
					}
				},
				{
					extend: 'pdfHtml5',
					oriented: 'portrait',
					pageSize: 'legal',
					title: 'Data Produk',
					download: 'open',
					exportOptions: {
						columns: [0, 1, 2, 3, 4]
					},
					customize: function(doc) {
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1)
							.join('*').split('');
						doc.styles.tableBodyEven.alignment = 'center';
						doc.styles.tableBodyOdd.alignment = 'center';
					}
				},
				{
					extend: 'print',
					oriented: 'portrait',
					pageSize: 'A4',
					title: 'Data Produk',
					exportOptions: {
						columns: [0, 1, 2, 3, 4]
					}
				}
			],
			"fnDrawCallback": function() {
				$('.image-link').magnificPopup({
					type: 'image',
					closeOnContentClick: true,
					closeBtnInside: false,
					fixedContentPos: true,
					image: {
						verticalFit: true
					},
					zoom: {
						enabled: true,
						duration: 300
					}
				});
			}
		});
	});
</script>