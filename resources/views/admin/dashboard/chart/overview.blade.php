@push('style')


<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

<style>

    .chart-apm-wrapper, .chart-rencana-produksi-dan-penjualan-wrapper, .chart-produksi-dan-penjualan-wrapper, .table-produksi-dan-penjualan-wrapper {
        margin:20px 0;
        background:#FFFFFF;
    }

    .btn-custom {
        margin-top:1.8em;
    }

    #chart-apm {
        display:block;
        margin:auto;
    }

    #chart-apm {
        width:450px;
        height:350px;
    }
    th, td {
        font-size:14px !important;
    }
</style>

@endpush

<div class="chart-apm-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div id="chart-apm"></div>
        </div>
    </div>
</div>


<form action="#" method="GET">
    <div class="container-fluid card shadow">
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6 col-lg-6 col-xs-12 col-sm-12">
                    @include('admin.component.select-apm')
                </div>

                <div class="form-group col-md-6 col-lg-6 col-xs-2 col-sm-2">
                    <button style="margin-top: 31px;" class="btn btn-dark btn-custom btn-block shadow"><i class="fa fa-eye"></i> Lihat Data</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="chart-rencana-produksi-dan-penjualan-wrapper">
    <div class="col-md-12">
        <div id="data-rencana-produksi-dan-penjualan">

        </div>
    </div>
</div>

<div class="chart-produksi-dan-penjualan-wrapper">
    <div class="col-md-12">
        <div id="data-produksi-dan-penjualan">

        </div>
    </div>
</div>

<div class="table-produksi-dan-penjualan-wrapper">
    <div class="col-md-12">
        <div id="table-data-produksi-dan-penjualan" class="table-responsive">

        </div>
    </div>
</div>




@push('scripts')

<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart-js/highchart.min.js')  }}"></script>


<script>

    let Overview = {
        init: function() {
            Overview.selectApm();
            Overview.dataChartApm();
            Overview.dataChartRealisasiProduksiDanPenjualan();
            Overview.dataChartRencanaRealisasiProduksiDanPenjualan();

            Highcharts.setOptions({
                lang: {
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });

        },
        dataChartApm: function() {
            $.ajax({
                url: "{{ route('report_apm') }}"
            }).done(function(response) {
                Overview.chartApm(response);
            });

        },

        dataChartRencanaRealisasiProduksiDanPenjualan:function() {

            $.ajax({
                url: "{{ route('report_rencana_produksi_dan_penjualan') }}",
                data: {
                    apm: "{{ request()->apm }}"
                },
            }).done(function(response) {
                Overview.chartRencanaProduksiDanPenjualan(response.data);
            });


        },

        dataChartRealisasiProduksiDanPenjualan: function() {
            $.ajax({
                url: "{{ route('report_realisasi_produksi_dan_penjualan') }}",
                data: {
                    apm: "{{ request()->apm }}"
                },
            }).done(function(response) {
                Overview.chartProduksiDanPenjualan(response.data);
                Overview.drawTableRealisasiProduksiDanPenjualan(response.data);
            });
        },

        chartApm: function(result) {

            Highcharts.chart('chart-apm', {
                chart: {
                    backgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                legend: {
                    layout: 'vertical'
                },
                title: {
                    text: 'APM KBH2 LCEV',
                    verticalAlign: 'bottom',
                    align: 'center',
                },
                tooltip: {
                    enabled: true,
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    pie: {
                        showInLegend: true,
                        allowPointSelect: true,
                        cursor: 'pointer',
                        colors: ["#6FAE47","#4572C4","#ED7D31","#A5A5A5","#FFC002","#5B9BD5"],
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                            distance: -50,
                            filter: {
                                property: 'percentage',
                                operator: '>',
                                value: 0
                            }
                        },
                    }
                },
                series: [{
                    data: result.data
                }],
                responsive: {

                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                align: 'right',
                                verticalAlign: 'top',
                                y: 90
                            }
                        }
                    }]
                }
            });
        },

        chartRencanaProduksiDanPenjualan: function(result) {

            Highcharts.chart('data-rencana-produksi-dan-penjualan', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafik Rencana, Produksi & Penjualan'
                },
                credits: {
                    enabled: false
                },
                colors:["#4572C4","#ED7D31","#A5A5A5"],
                xAxis: {
                    categories: result.month,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    shared: true,
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.3,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Rencana',
                    data: result.data.rencana_produksi

                },{
                    name: 'Produksi',
                    data: result.data.produksi

                }, {
                    type: 'spline',
                    name: 'Penjualan',
                    data: result.data.penjualan

                }]
            });
        },

        chartProduksiDanPenjualan: function(result) {
            Highcharts.chart('data-produksi-dan-penjualan', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafik Realisasi Produksi & Penjualan'
                },
                credits: {
                    enabled: false
                },
                colors:["#ABD290","#BCD4EB"],
                xAxis: {
                    categories: result.model,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    }
                },
                tooltip: {
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.3,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Produksi',
                    data: result.produksi

                }, {
                    name: 'Penjualan',
                    data: result.penjualan

                }]
            });
        },
        drawTableRealisasiProduksiDanPenjualan: function(result) {

            var model = '';
            var produksi = '';
            var penjualan = '';


            result.model.forEach(function(value, key) {
                model += '<th style="width: 10%;padding: 0; text-align: center; vertical-align: middle;">'+value+'</th>';
            })

            result.produksi.forEach(function(value, key) {
                produksi += '<td>'+Overview.thousand_separator(value)+'</td>';
            })

            result.penjualan.forEach(function(value, key) {
                penjualan += '<td>'+Overview.thousand_separator(value)+'</td>';
            })

            let table = '<table class="table table-bordered table-hover">'+
                '<thead>'+
                    '<tr>'+
                        '<th style="border-top:1px solid #ffffff; border-left:1px solid #ffffff;"></th>'+
                        model+
                    '</tr>'+
                '</thead>'+
                '<tbody>'+
                    '<tr>'+
                        '<td>Produksi</td>'+
                        produksi+
                    '</tr>'+
                    '<tr>'+
                        '<td>Penjualan</td>'+
                        penjualan+
                    '</tr>'+

                '</tbody>'+
            '</table>';

            $('#table-data-produksi-dan-penjualan').html(table);

        },
        selectApm: function() {
            $('.apm').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('master-data-apm-cari') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        },

        thousand_separator: function(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }

    $( document ).ready(function() {
        Overview.init();
    });



</script>

@endpush
