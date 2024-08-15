<section class="content">
	<div class="row">
		<div class='col-xs-12'>
			<div class='box box-primary'>
				<div class='box-header with-border'>
					<h3 class='box-title'>Edit Data Produk</h3>
				</div>
				<div class="box-body">
					<?php echo form_open_multipart('produk/edit', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>

					<div class="form-group">
						<label for="nama_produk" class="control-label">Nama Produk</label>
						<div class="input-group">
							<input type="text" class="form-control" name="nama_produk" id="nama_produk" value="<?php echo $record['nama_produk']; ?>" data-error="Nama Produk harus diisi" placeholder="Nama Produk" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>

					<div class="form-group">
						<label for="harga_awal" class="control-label">Harga Minimal</label>
						<div class="input-group">
							<input type="text" class="form-control" name="harga_awal" id="harga_awal" value="<?php echo $record['harga']; ?>" data-error="Harga awal harus diisi" placeholder="Harga Awal" required />
							<span class="input-group-addon">
								<span class="fa fa-money"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>

					<div class="form-group">
						<label for="harga_akhir" class="control-label">Harga Maksimal</label>
						<div class="input-group">
							<input type="text" class="form-control" name="harga_akhir" id="harga_akhir" value="<?php echo $record['harga_akhir']; ?>" data-error="Harga Akhir harus diisi" placeholder="Harga Akhir" required />
							<span class="input-group-addon">
								<span class="fa fa-money"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>


					<div class="box-footer">
						<input type="hidden" name="id_produk" value="<?php echo $record['id_produk']; ?>" />
						<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
						<a href="<?php echo base_url() ?>produk" class="btn btn-default">Cancel</a>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(function() {
		$('#tipe').change(function() {
			if ($('#tipe').val() == 'Net') {

				$('#f_ket').hide();
			} else {
				$('#f_ket').show();
			}
		});
	});
</script>