<?php $CI = &get_instance();
$session = $CI->session->userdata;
?>

<style type="text/css">
table,
th,
tr,
td {
    text-align: center;
}

.swal2-popup {
    font-family: inherit;
    font-size: 1.2rem;
}

.btn-group,
.btn-group-vertical {
    position: relative;
    display: initial;
    vertical-align: middle;
}
</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class='box-header  with-border'>
                    <h3 class='box-title'>Data Laporan</h3>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <?php echo form_open('lapsales', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
                        <div class="col-md-3">
                            <div class="input-daterange">
                                <div class="form-group">
                                    <label for="start_date" class="control-label">Tanggal Awal</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="start_date" id="start_date"
                                            data-error="Tanggal Awal harus diisi" readonly required />
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-daterange">
                                <div class="form-group">
                                    <label for="end_date" class="control-label">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="end_date" id="end_date"
                                            data-error="Tanggal Akhir harus diisi" readonly required />
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sales_name" class="control-label">Nama Sales</label>
                                <select class="form-control" name="sales_name" id="sales_name" required>
                                    <option value="">Pilih Nama Sales</option>
                                    <?php foreach ($sales_list as $sales) : ?>
                                        <option value="<?php echo $sales->nama_operator; ?>"><?php echo $sales->nama_operator; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-top:25px;">
                            <button type="submit" name="search" id="search" value="Search" class="btn btn-info">
                                Search</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="box-body">
                    <?php if ($session['akses'] == 2) : ?>
                    <table id="myTable" class="table table-bordered table-hover">
                        <?php else : ?>
                        <table id="" class="table table-bordered table-hover">
                            <?php endif; ?>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sales</th>
                                    <th>No Transaksi</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($laporan as $row) { ?>
                                <tr>
                                    <td><?php echo ++$no; ?></td>
                                    <td><?php echo $row->operator; ?></td>
                                    <td><?php echo $row->no_trf; ?></td>
                                    <td><?php echo $row->nama_produk ?></td>
                                    <td><?php echo $row->grand_total; ?></td>
                                    <td><?php echo $row->tgl_trf . ' ' . $row->jam_trf; ?></td>
                                    <td><?php
                                        echo anchor(site_url('penjualan/struk/' . $row->id), '<i class="fa fa-eye"></i>&nbsp;&nbsp;Detail', array('title' => 'edit', 'class' => 'btn btn-sm btn-info'));
                                        echo '&nbsp';
                                        //echo anchor(site_url('laporan/hapus/' . $row->id), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
                                        ?>
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
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
$(document).ready(function() {
    $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: "yyyy-mm-dd",
        autoclose: true
    });
    $('#myTable').DataTable({
        dom: 'Blfrtip',
        buttons: [{
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                },
            },
            {
                extend: 'excelHtml5',
                title: 'LAPORAN PENJUALAN',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                },
            },
            {
                extend: 'copyHtml5',
                title: 'LAPORAN PENJUALAN',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                },
            },
            {
                extend: 'pdfHtml5',
                oriented: 'portrait',
                pageSize: 'legal',
                title: 'LAPORAN PENJUALAN',
                download: 'open',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                },
                customize: function(doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1)
                        .join('*').split('');
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                },
            },
            {
                extend: 'print',
                oriented: 'portrait',
                pageSize: 'A4',
                title: 'LAPORAN PENJUALAN',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                },

            },
        ],
    });
});
</script>
