
@push('style')


<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/select2/css/select2-bootstrap4.min.css') }}">

<style>
    .chart-supplier-apm-kolompok-komponen, .chart-supplier-komponen-apm{
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


<div class="chart-supplier-apm-kolompok-komponen">
    <div class="col-md-12">
        <div id="data-supplier-apm-kolompok-komponen">

        </div>
    </div>
</div>

<hr>

<form action="#" method="GET" name="form-supplier" class="needs-validation" novalidate>
    <div class="container-fluid card shadow">
        <div class="card-body">
            <div class="form-row">

                <input type="hidden" name="apm" value="{{ !empty(request()->apm) ? request()->apm : '' }}">

                <div class="form-group col-md-8 col-lg-8 col-xs-12 col-sm-12">
                    <label for="komponen_kategori">Pilih Kategori Komponen :</label>
                    <select name="komponen_kategori" class="form-control komponen_kategori" required>

                        @if(!empty($data['komponen_kategori']))
                            <option value="{{ $data['komponen_kategori']->id }}" selected>{{ $data['komponen_kategori']->nama_kategori_komponen }}</option>
                        @else
                            <option value="">-- Pilih Kategori Komponen --</option>
                        @endif
                        
                    </select>
                    <div class="invalid-feedback">
                        Kategori Komponen tidak boleh kosong
                    </div>
                </div>

                <div class="form-group col-md-4 col-lg-4 col-xs-2 col-sm-2">
                    <button style="margin-top: 31px;" class="btn btn-dark btn-custom btn-block shadow"><i class="fa fa-eye"></i> Lihat Data</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="chart-supplier-komponen-apm">
    <div class="col-md-12">
        <div id="data-supplier-komponen-apm">

        </div>
    </div>
</div>




@push('scripts')

<script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart-js/highchart.min.js')  }}"></script>


<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
    })();
</script>

<script>

    var statistikSupplier = {

        init: function() {

            statistikSupplier.selectApm();
            statistikSupplier.selectKomponenKategori();
            statistikSupplier.chartDataSupplierKelompokApm();
            statistikSupplier.chartDataSupplierApmKelompokKomponen();

            Highcharts.setOptions({
                lang: {
                    decimalPoint: ',',
                    thousandsSep: '.'
                }
            });
        },
        

        chartDataSupplierKelompokApm: function() {
            $.ajax({
                url: "{{ route('report_supplier_komponen_apm') }}",
                data: {
                    apm: "{{ request()->apm }}",
                    komponen_kategori: "{{ request()->komponen_kategori }}",
                },
            }).done(function(response) {
                statistikSupplier.dataSupplierKelompokApm(response.data);
            }).fail(function(error) {
                
            });
            
        },

        chartDataSupplierApmKelompokKomponen: function() {


            $.ajax({
                url: "{{ route('report_supplier_apm_kelompok_komponen') }}",
                data: {
                    apm: "{{ request()->apm }}"
                },
            }).done(function(response) {
                statistikSupplier.dataSupplierApmKelompokKomponen(response.data);
            }).fail(function(error) {
                $('#data-supplier-apm-kolompok-komponen').html('<p style="text-align:center">'+error.responseJSON.message+'</p>')
            });
            
            
        },

        dataSupplierKelompokApm: function(result) {
            Highcharts.chart('data-supplier-komponen-apm', {

                title: {
                    text: 'Jumlah Supplier Komponen per APM'
                },

                yAxis: {
                    title: {
                        text: ''
                    }
                },

                xAxis: {
                    categories: result.categories,
                    crosshair: true
                },

                credits: {
                    enabled: false
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
        },

        dataSupplierApmKelompokKomponen: function(result) {
            Highcharts.chart('data-supplier-apm-kolompok-komponen', {

                title: {
                    text: 'Jumlah Supplier APM per Kelompok Komponen'
                },

                yAxis: {
                    title: {
                        text: ''
                    }
                },

                xAxis: {
                    categories: result.categories,
                    crosshair: true
                },

                credits: {
                    enabled: false
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

        selectKomponenKategori: function() {
            $('.komponen_kategori').select2({
                theme: 'bootstrap4',
                ajax: {
                    url: "{{ route('master-data-komponen-cari') }}",
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
        statistikSupplier.init();
    });


</script>

@endpush