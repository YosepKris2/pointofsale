<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <style>
        .chart-container {
            width: 100%; /* Lebar penuh */
            height: 500px; /* Tinggi tetap */
            margin-bottom: 20px; /* Jarak antar diagram */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
    
</head>

<body>
    <section class="content">
        <?php if ($this->session->userdata('akses') == 1) : ?>
            <form method="POST" action="<?= base_url('dashboard/index') ?>">
                <div class="form-group">
                    <label for="start_date">Tanggal Awal:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
                <div class="form-group">
                    <label for="end_date">Tanggal Akhir:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                
            </form>
        <?php endif; ?>

        <?php if ($this->session->userdata('akses') == 1) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Urutan produk paling banyak terjual</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart-container">
                                <canvas id="chartdiv2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Grafik Penjualan Produk dari Waktu ke Waktu</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart-container">
                                <canvas id="chartdiv3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-widget widget-user">
                        <div class="widget-user-header bg-green-active">
                            <p style="text-align: center;">
                                <span style="font-family: georgia, palatino; font-size: 15pt;">Selamat datang di PT. Troya
                                    Digital Mesail</span>
                            </p>
                            <h3 class="widget-user-username"></h3>
                            <h5 class="widget-user-desc"></h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="<?php echo base_url(); ?>assets/dist/img/Troya Digital.png">
                        </div>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                    </div>
                                </div>
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Kantor: Jl. Jambon No.4, RT.02/RW.30, Biru,
                                            Trihanggo, Kec. Gamping, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55291</h5>
                                        <span class="description-text">No.Telp:(0274) 5025651</span>
                                    </div>
                                    <center>
                                        <i>Sistem Laporan Penjualan</i><br>
                                    </center>
                                </div>
                                <div class="col-sm-3">
                                    <div class="description-block">
                                        <h5 class="description-header"></h5>
                                        <span class="description-text"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Skrip untuk diagram yang tersisa
            const top3ProdukData = <?php echo json_encode($top_3_produk); ?>;
            const penjualanWaktuKeWaktuData = <?php echo json_encode($penjualan_waktu_ke_waktu); ?>;
            const colors = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ];
            const borderColors = [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];

            new Chart(document.getElementById('chartdiv2').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: top3ProdukData.map(item => item.nama_produk),
                    datasets: [{
                        label: 'Produk paling banyak terjual',
                        data: top3ProdukData.map(item => item.total_penjualan),
                        backgroundColor: top3ProdukData.map((_, index) => colors[index % colors.length]),
                        borderColor: top3ProdukData.map((_, index) => borderColors[index % borderColors.length]),
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.label}: ${context.raw}`;
                                }
                            }
                        }
                    }
                }
            });

            const penjualanData = penjualanWaktuKeWaktuData.reduce((acc, item) => {
                const date = item.tgl_trf;
                if (!acc[date]) acc[date] = {};
                if (!acc[date][item.id_produk]) acc[date][item.id_produk] = {
                    nama_produk: item.nama_produk,
                    total_jumlah: 0
                };
                acc[date][item.id_produk].total_jumlah += parseInt(item.total_jumlah);
                return acc;
            }, {});

            const labels = Object.keys(penjualanData);
            const datasets = [];
            const productIds = {};

            penjualanWaktuKeWaktuData.forEach(item => {
                if (!productIds[item.id_produk]) {
                    productIds[item.id_produk] = item.nama_produk;
                }
            });

            Object.keys(productIds).forEach((id, index) => {
                datasets.push({
                    label: productIds[id],
                    data: labels.map(date => penjualanData[date][id] ? penjualanData[date][id].total_jumlah : 0),
                    borderColor: colors[index % colors.length],
                    backgroundColor: 'rgba(0,0,0,0)', // Ensure line is not filled
                    yAxisID: 'y',
                    fill: false
                });
            });

            new Chart(document.getElementById('chartdiv3').getContext('2d'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'll'
                            },
                            title: {
                                display: true,
                                text: 'Tanggal Transaksi'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Jumlah Produk Terjual'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.raw}`;
                                }
                            }
                        },
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>
