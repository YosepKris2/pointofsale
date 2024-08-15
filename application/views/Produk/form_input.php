<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4> <i class="icon fa fa-ban"></i> Error</h4>
        <p><?php echo $this->session->flashdata('message'); ?></p>
    </div>
</div>
<?php } else {
} ?>
<section class="content">
    <div class="row">
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>Tambah Data Produk</h3>
                </div>
                <div class="box-body">
                    <?php echo form_open_multipart('Produk/post', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>

                    <div class="form-group">
                        <label for="nama_produk" class="control-label">Nama Produk</label>
                        <div class="input-group">
                            <input type="text" name="nama_produk" id="nama_produk" data-error="Nama produk harus diisi" class="form-control"
                                placeholder="Nama Produk" required>
                            <span class="input-group-addon">
                                <span class="fa fa-cube"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <label for="harga_awal" class="control-label">Harga Minimal</label>
                        <div class="input-group">
                            <input type="text" name="harga_awal" id="harga_awal"  data-error="Harga harus diisi" class="form-control"
                                placeholder="Harga Awal" required >
                            <span class="input-group-addon">
                                <span class="fas fa-money-bill-wave"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="harga_akhir" class="control-label">Harga Maksimal</label>
                        <div class="input-group">
                            <input type="text" name="harga_akhir" id="harga_akhir" data-error="Harga harus diisi"
                                class="form-control" placeholder="Harga Akhir" required>
                            <span class="input-group-addon">
                                <span class="fas fa-money-bill"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

            </div>
            <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <a href="<?php echo base_url() ?>produk" class="btn btn-default">Cancel</a>
            </div>
            </form>
        </div>
    </div>
</section>


<script>
// $(document).ready(function() {
//     $('#nama_produk').change(function() {
//         var selectedOption = $(this).find('option:selected');
//         var hargaAwal = selectedOption.data('harga-awal');
//         var hargaAkhir = selectedOption.data('harga-akhir');
//         var hargaTetap = selectedOption.data('harga-tetap');

//         $('#range_harga').val('Rp.' + hargaAwal + ' - ' + 'Rp.' + hargaAkhir);
//         $('#harga').val(hargaTetap);
//     });
// });
</script>
