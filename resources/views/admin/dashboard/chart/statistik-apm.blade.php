
@push('style')


<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

<style>
    .chart-realisasi-komponen-lokal-apm, .chart-realisasi-komponen-lokal-model, .chart-penjualan-model{
        margin:20px 0;
        background:#FFFFFF;
    }
</style>


@endpush


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


<div class="chart-realisasi-komponen-lokal-apm">
    <div class="col-md-12">
        <div id="data-realisasi-komponen-lokal-apm">

        </div>
    </div>
</div>

<div class="chart-realisasi-komponen-lokal-model">
    <div class="col-md-12">
        <div id="data-realisasi-komponen-lokal-model">

        </div>
    </div>
</div>

<div class="chart-penjualan-model">
    <div class="col-md-12">
        <div id="data-penjualan-model">

        </div>
    </div>
</div>




@push('scripts')

<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart-js/highchart.min.js')  }}"></script>


<script>

    var statistikApm = {

        init: function() {

            statistikApm.selectApm();
            statistikApm.chartPenjualanModel();
            statistikApm.chartRealisasiKomponenLokalApm();
            statistikApm.chartRealisasiKomponenLokalModel();

            Highcharts.setOptions({
                lang: {
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });
        },

        chartPenjualanModel: function() {

            $.ajax({
                url: "{{ route('report_penjualan_model') }}",
                data: {
                    apm: "{{ request()->apm }}"
                },
            }).done(function(response) {
                statistikApm.dataPenjualanModel(response.data);
            });

        },

        chartRealisasiKomponenLokalApm: function() {
            $.ajax({
                url: "{{ route('report_realisasi_komponen_lokal_apm') }}",
                data: {
                    apm: "{{ request()->apm }}"
                },
            }).done(function(response) {
                statistikApm.dataRealisasiKomponenLokalApm(response.data);
            });

        },

        chartRealisasiKomponenLokalModel: function() {
            $.ajax({
                url: "{{ route('report_realisasi_komponen_lokal_model') }}",
                data: {
                    apm: "{{ request()->apm }}"
                },
            }).done(function(response) {
                statistikApm.dataRealisasiKomponenLokalModel(response.data);
            });

        },

        dataRealisasiKomponenLokalApm: function(result) {
            Highcharts.chart('data-realisasi-komponen-lokal-apm', {
                chart: {
                    type: 'bar', // Set the chart type to bar
                },
                title: {
                    text: 'Realisasi Komponen Lokal APM'
                },
                xAxis: {
                    categories: result.month,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: ''
                    },
                    labels: {
                        format: '{value} %'
                    },
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y} %</b><br/>',
                },
                series: result.data,
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });

            // Highcharts.chart('data-realisasi-komponen-lokal-apm', {

            //     title: {
            //         text: 'Realisasi Komponen Lokal APM'
            //     },

            //     yAxis: {
            //         min: 0,
            //         title: {
            //             text: ''
            //         },
            //         labels: {
            //             format: '{value} %'
            //         },
            //     },

            //     xAxis: {
            //         categories: result.month,
            //         crosshair: true
            //     },
            //     credits: {
            //         enabled: false
            //     },

            //     tooltip: {
            //         pointFormat: '{series.name}: <b>{point.y} %</b><br/>',
            //     },

            //     series: result.data,
            //     responsive: {
            //         rules: [{
            //             condition: {
            //                 maxWidth: 500
            //             },
            //             chartOptions: {
            //                 legend: {
            //                     layout: 'horizontal',
            //                     align: 'center',
            //                     verticalAlign: 'bottom'
            //                 }
            //             }
            //         }]
            //     }

            //     });
        },

        dataRealisasiKomponenLokalModel: function(result) {
            Highcharts.chart('data-realisasi-komponen-lokal-model', {
                chart: {
                    type: 'bar', // Set the chart type to bar
                },
                title: {
                    text: 'Realisasi Komponen Lokal Model'
                },
                xAxis: {
                    categories: result.month,
                    crosshair: true
                },
                yAxis: {
                    title: {
                        text: ''
                    },
                    labels: {
                        format: '{value} %'
                    },
                },
                credits: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.y} %</b><br/>',
                },
                series: result.data,
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });

            // Highcharts.chart('data-realisasi-komponen-lokal-model', {

            //     title: {
            //         text: 'Realisasi Komponen Lokal Model'
            //     },

            //     yAxis: {
            //         title: {
            //             text: ''
            //         },
            //         labels: {
            //             format: '{value} %'
            //         },
            //     },
            //     credits: {
            //         enabled: false
            //     },

            //     xAxis: {
            //         categories: result.month,
            //         crosshair: true
            //     },

            //     tooltip: {
            //         pointFormat: '{series.name}: <b>{point.y} %</b><br/>',
            //     },

            //     series: result.data,
            //     responsive: {
            //         rules: [{
            //             condition: {
            //                 maxWidth: 500
            //             },
            //             chartOptions: {
            //                 legend: {
            //                     layout: 'horizontal',
            //                     align: 'center',
            //                     verticalAlign: 'bottom'
            //                 }
            //             }
            //         }]
            //     }

            // });

        },

        dataPenjualanModel: function(result) {
            Highcharts.chart('data-penjualan-model', {
                chart: {
                    type: 'bar', // Set the chart type to bar
                },
                title: {
                    text: 'Jumlah Penjualan Per Model'
                },
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
                    pointFormat: '{series.name}: <b>{point.y} Unit</b><br/>',
                    valueSuffix: '',
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.3,
                        borderWidth: 0
                    }
                },
                series: result.data,
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });

            // Highcharts.chart('data-penjualan-model', {

            //     title: {
            //         text: 'Jumlah Penjualan Per Model'
            //     },

            //     yAxis: {
            //         min: 0,
            //         title: {
            //             text: ''
            //         }
            //     },

            //     xAxis: {
            //         categories: result.month,
            //         crosshair: true
            //     },

            //     tooltip: {
            //         pointFormat: '{series.name}: <b>{point.y} Unit</b><br/>',
            //         valueSuffix: '',
            //     },

            //     credits: {
            //         enabled: false
            //     },
            //     plotOptions: {
            //         column: {
            //             pointPadding: 0.3,
            //             borderWidth: 0
            //         }
            //     },
            //     series: result.data,

            //     responsive: {
            //         rules: [{
            //             condition: {
            //                 maxWidth: 500
            //             },
            //             chartOptions: {
            //                 legend: {
            //                     layout: 'horizontal',
            //                     align: 'center',
            //                     verticalAlign: 'bottom'
            //                 }
            //             }
            //         }]
            //     }

            //     });
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
        }
    }

    $( document ).ready(function() {
        statistikApm.init();
    });


</script>

@endpush
