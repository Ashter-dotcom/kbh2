@push('style')

<style>
    *,
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    * {
        position: relative;
        margin: 0;
        padding: 0;
        border: 0 none;
    }

    .nav-custom {
        display:grid;
        margin: 0 auto;
        width: 100%;
        min-height: auto;
    }

    .nav-custom ul {
        position: relative;
        padding-top: 5em;
    }

    .nav-custom li {
        position: relative;
        padding: 20px 3px 0 3px;
        float: left;

        text-align: center;
        list-style-type: none;
    }

    .nav-custom li::before, .nav-custom li::after{
        content: '';
        position: absolute;
        top: 5px;
        right: 50%;
        width: 50%;
        height: 26px;
        border-top: 2px solid #ccc;
    }

    .nav-custom li::after{
        left: 50%;
        right: auto;
        border-left: 2px solid #ccc;
    }

    .nav-custom li:only-child::after, .nav-custom li:only-child::before {
        content: '';
        display: none;
    }

    .nav-custom li:only-child{ padding-top: 0;}
    .nav-custom li:first-child::before, .nav-custom li:last-child::after{
        border: 0 none;
    }

    .nav-custom li:last-child::before{
        border-right: 2px solid #ccc;
        border-radius: 0 5px 0 0;
    }

    .nav-custom li:first-child::after{
        border-radius: 5px 0 0 0;
    }

    .nav-custom ul ul::before{
        content: '';
        position: absolute;
        bottom: -7px;
        border-left: 2px solid #ccc;
        width: 0;
        height: 37px;
    }

    .nav-custom li a{
        display: inline-block;
        padding: 10px 10px;
        text-decoration: none;
        text-transform: uppercase;
        color: #666666;
        font-weight: bold;
        font-family: arial, verdana, tahoma;
        font-size: 12px;
        width: 400px;
        height: 80px;
    }

    .wrapper {
        display:block;
        margin:auto;
        overflow:scroll;
        z-index: 1;
        height:850px;
    }
    .modal {
        overflow: auto !important;
    }

    th, td {
        font-size:12px !important;
    }


</style>

@endpush


<div class="pohon-industri">
    <div class="row">
        <div class="col-md-12">
            <nav class="nav-custom">
                <div class="wrapper">
                    <ul style="padding:0">
                        <li>
                            <a href="#">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Jumlah Supplier</th>
                                            <th id="total_supplier"></th>
                                        </tr>
                                    </thead>
                                </table>
                            </a>
                            <ul style="padding:0">
                                <li class="komponen_left"></li>
                                <li class="komponen_right"></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKomponenKategori" tabindex="-1" data-target=".modalKomponenKategori" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Komponen</th>
                                <th>Jumlah Supplier</th>
                                <th>Jumlah Tenaga Kerja</th>
                                <th>Lihat Supplier</th>
                            </tr>
                        </thead>
                        <tbody class="display_komponen">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_supplier_komponen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Perusahaan Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Supplier</th>
                                <th>Tenaga Kerja</th>
                                <th>Alamat Pabrik</th>
                                <th>Email PIC</th>
                                <th>No. Telp</th>
                            </tr>
                        </thead>
                        <tbody class="display_supplier">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')

<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>

<script>

    let PohonIndustri = {
        init: function() {
            PohonIndustri.dataReportPohonIndutri();
        },

        dataReportPohonIndutri: function() {
            $.ajax({
                url: "{{ route('report-pohon-industri') }}"
            }).done(function(response) {

                let data = response.data.data;
                $('#total_supplier').html(response.data.total_supplier);

                PohonIndustri.komponen_left(data);
                PohonIndustri.komponen_right(data);
            });
        },

        data_modal_komponen: function(kategori_komponen) {

            $('#modalLabel').html(kategori_komponen);

            $.ajax({
                url: "{{ route('report-pohon-industri-kategori-komponen') }}",
                data: {
                    'nama_kategori_komponen' : kategori_komponen
                }
            }).done(function(response) {

                let template = '';
                let data = response.data;

                data.forEach(function(value, index) {
                    template += '<tr>'+
                                    '<td>'+value.nama_komponen+'</td>'+
                                    '<td>'+value.jumlah_supplier+'</td>'+
                                    '<td>'+value.jumlah_tenaga_kerja+'</td>'+
                                    '<td><i class="fas fa-eye" style="cursor:pointer" onclick="PohonIndustri.lihat_supplier(\''+value.kategori_id+'\', \''+kategori_komponen+'\')"></i></td>'+
                                '</tr>';
                });

                $('#modalKomponenKategori').on('shown.bs.modal', function (e) {
                    $('.display_komponen').html(template)
                });

                $('#modalKomponenKategori').modal('show')
            });
        },

        lihat_supplier: function(kategori_id, kategori_komponen_name) {

            $.ajax({
                url: "{{ route('report-pohon-industri-supplier') }}",
                data: {
                    'kategori_Id' : kategori_id
                }
            }).done(function(response) {

                let template = '';
                let data = response.data;

                data.forEach(function(value, index) {

                    template += '<tr>'+
                        '<td>'+value.supplier+'</td>'+
                        '<td>'+value.tenaga_kerja+'</td>'+
                        '<td>'+value.alamat_pabrik+'</td>'+
                        '<td>'+value.email_pic+'</td>'+
                        '<td>'+value.no_tlp_pic+'</td>'+
                    '</tr>';
                });

                $('#modal_supplier_komponen').on('shown.bs.modal', function (e) {
                    $('.display_supplier').html(template)
                });

                $('#modal_supplier_komponen').modal('show')


            }).fail(function() {
                alert('Data Belum Tersedia');
            });
        },

        komponen_left: function(response) {

            let data = response.slice(0,6);

            let element = '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[0].name+'\')">'+
                '<table class="table table-bordered table-hover table-striped">'+
                    '<thead class="thead-dark">'+
                        '<tr>'+
                            '<th>'+data[0].name+'</th>'+
                            '<th>Jumlah</th>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody>'+
                        '<tr>'+
                            '<td>Perusahaan Supplier</td>'+
                            '<td>'+data[0].total+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Tenaga Kerja</td>'+
                            '<td>'+data[0].tenaga_kerja+'</td>'+
                        '</tr>'+
                    '</tbody>'+
                '</table>'+
            '</a>'+
            '<ul>'+
                '<li>'+
                    '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[1].name+'\')">'+
                        '<table class="table table-bordered table-hover table-striped">'+
                            '<thead class="thead-dark">'+
                                '<tr>'+
                                    '<th>'+data[1].name+'</th>'+
                                    '<th>Jumlah</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody>'+
                                '<tr>'+
                                    '<td>Steering System</td>'+
                                    '<td>'+data[1].total+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td>Tenaga Kerja</td>'+
                                    '<td>'+data[1].tenaga_kerja+'</td>'+
                                '</tr>'+
                            '</tbody>'+
                        '</table>'+
                    '</a>'+
                    '<ul>'+
                        '<li>'+
                            '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[2].name+'\')">'+
                                '<table class="table table-bordered table-hover table-striped">'+
                                    '<thead class="thead-dark">'+
                                        '<tr>'+
                                            '<th>'+data[2].name+'</th>'+
                                            '<th>Jumlah</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>'+
                                        '<tr>'+
                                            '<td>Perusahaan Supplier</td>'+
                                            '<td>'+data[2].total+'</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td>Tenaga Kerja</td>'+
                                            '<td>'+data[2].tenaga_kerja+'</td>'+
                                        '</tr>'+
                                    '</tbody>'+
                                '</table>'+
                            '</a>'+
                            '<ul>'+
                                '<li>'+
                                    '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[3].name+'\')">'+
                                        '<table class="table table-bordered table-hover table-striped">'+
                                            '<thead class="thead-dark">'+
                                                '<tr>'+
                                                    '<th>'+data[3].name+'</th>'+
                                                    '<th>Jumlah</th>'+
                                                '</tr>'+
                                            '</thead>'+
                                            '<tbody>'+
                                                '<tr>'+
                                                    '<td>Perusahaan Supplier</td>'+
                                                    '<td>'+data[3].total+'</td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<td>Tenaga Kerja</td>'+
                                                    '<td>'+data[3].tenaga_kerja+'</td>'+
                                                '</tr>'+
                                            '</tbody>'+
                                        '</table>'+
                                    '</a>'+
                                    '<ul>'+
                                        '<li>'+
                                            '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[4].name+'\')">'+
                                                '<table class="table table-bordered table-hover table-striped">'+
                                                    '<thead class="thead-dark">'+
                                                        '<tr>'+
                                                            '<th>'+data[4].name+'</th>'+
                                                            '<th>Jumlah</th>'+
                                                        '</tr>'+
                                                    '</thead>'+
                                                    '<tbody>'+
                                                        '<tr>'+
                                                            '<td>Perusahaan Supplier</td>'+
                                                            '<td>'+data[4].total+'</td>'+
                                                        '</tr>'+
                                                        '<tr>'+
                                                            '<td>Tenaga Kerja</td>'+
                                                            '<td>'+data[4].tenaga_kerja+'</td>'+
                                                        '</tr>'+
                                                    '</tbody>'+
                                                '</table>'+
                                            '</a>'+
                                            '<ul>'+
                                                '<li>'+
                                                    '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[5].name+'\')">'+
                                                        '<table class="table table-bordered table-hover table-striped">'+
                                                            '<thead class="thead-dark">'+
                                                                '<tr>'+
                                                                    '<th>'+data[5].name+'</th>'+
                                                                    '<th>Jumlah</th>'+
                                                                '</tr>'+
                                                            '</thead>'+
                                                            '<tbody>'+
                                                                '<tr>'+
                                                                    '<td>Perusahaan Supplier</td>'+
                                                                    '<td>'+data[5].total+'</td>'+
                                                                '</tr>'+
                                                                '<tr>'+
                                                                    '<td>Tenaga Kerja</td>'+
                                                                    '<td>'+data[5].tenaga_kerja+'</td>'+
                                                                '</tr>'+
                                                            '</tbody>'+
                                                        '</table>'+
                                                    '</a>'+
                                                '</li>'+
                                            '</ul>'+
                                        '</li>'+
                                    '</ul>'+
                                '</li>'+
                            '</ul>'+
                        '</li>'+
                    '</ul>'+
                '</li>'+
            '</ul>';


            $('.komponen_left').html(element);
        },
        komponen_right: function(response) {

            let data = response.slice(6,12);

            let element = '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[0].name+'\')">'+
                '<table class="table table-bordered table-hover table-striped">'+
                    '<thead class="thead-dark">'+
                        '<tr>'+
                            '<th>'+data[0].name+'</th>'+
                            '<th>Jumlah</th>'+
                        '</tr>'+
                    '</thead>'+
                    '<tbody>'+
                        '<tr>'+
                            '<td>Perusahaan Supplier</td>'+
                            '<td>'+data[0].total+'</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Tenaga Kerja</td>'+
                            '<td>'+data[0].tenaga_kerja+'</td>'+
                        '</tr>'+
                    '</tbody>'+
                '</table>'+
            '</a>'+
            '<ul>'+
                '<li>'+
                    '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[1].name+'\')">'+
                        '<table class="table table-bordered table-hover table-striped">'+
                            '<thead class="thead-dark">'+
                                '<tr>'+
                                    '<th>'+data[1].name+'</th>'+
                                    '<th>Jumlah</th>'+
                                '</tr>'+
                            '</thead>'+
                            '<tbody>'+
                                '<tr>'+
                                    '<td>Steering System</td>'+
                                    '<td>'+data[1].total+'</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td>Tenaga Kerja</td>'+
                                    '<td>'+data[1].tenaga_kerja+'</td>'+
                                '</tr>'+
                            '</tbody>'+
                        '</table>'+
                    '</a>'+
                    '<ul>'+
                        '<li>'+
                            '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[2].name+'\')">'+
                                '<table class="table table-bordered table-hover table-striped">'+
                                    '<thead class="thead-dark">'+
                                        '<tr>'+
                                            '<th>'+data[2].name+'</th>'+
                                            '<th>Jumlah</th>'+
                                        '</tr>'+
                                    '</thead>'+
                                    '<tbody>'+
                                        '<tr>'+
                                            '<td>Perusahaan Supplier</td>'+
                                            '<td>'+data[2].total+'</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td>Tenaga Kerja</td>'+
                                            '<td>'+data[2].tenaga_kerja+'</td>'+
                                        '</tr>'+
                                    '</tbody>'+
                                '</table>'+
                            '</a>'+
                            '<ul>'+
                                '<li>'+
                                    '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[3].name+'\')">'+
                                        '<table class="table table-bordered table-hover table-striped">'+
                                            '<thead class="thead-dark">'+
                                                '<tr>'+
                                                    '<th>'+data[3].name+'</th>'+
                                                    '<th>Jumlah</th>'+
                                                '</tr>'+
                                            '</thead>'+
                                            '<tbody>'+
                                                '<tr>'+
                                                    '<td>Perusahaan Supplier</td>'+
                                                    '<td>'+data[3].total+'</td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<td>Tenaga Kerja</td>'+
                                                    '<td>'+data[3].tenaga_kerja+'</td>'+
                                                '</tr>'+
                                            '</tbody>'+
                                        '</table>'+
                                    '</a>'+
                                    '<ul>'+
                                        '<li>'+
                                            '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[4].name+'\')">'+
                                                '<table class="table table-bordered table-hover table-striped">'+
                                                    '<thead class="thead-dark">'+
                                                        '<tr>'+
                                                            '<th>'+data[4].name+'</th>'+
                                                            '<th>Jumlah</th>'+
                                                        '</tr>'+
                                                    '</thead>'+
                                                    '<tbody>'+
                                                        '<tr>'+
                                                            '<td>Perusahaan Supplier</td>'+
                                                            '<td>'+data[4].total+'</td>'+
                                                        '</tr>'+
                                                        '<tr>'+
                                                            '<td>Tenaga Kerja</td>'+
                                                            '<td>'+data[4].tenaga_kerja+'</td>'+
                                                        '</tr>'+
                                                    '</tbody>'+
                                                '</table>'+
                                            '</a>'+
                                            '<ul>'+
                                                '<li>'+
                                                    '<a href="javascript:void(0)" onclick="PohonIndustri.data_modal_komponen(\''+data[5].name+'\')">'+
                                                        '<table class="table table-bordered table-hover table-striped">'+
                                                            '<thead class="thead-dark">'+
                                                                '<tr>'+
                                                                    '<th>'+data[5].name+'</th>'+
                                                                    '<th>Jumlah</th>'+
                                                                '</tr>'+
                                                            '</thead>'+
                                                            '<tbody>'+
                                                                '<tr>'+
                                                                    '<td>Perusahaan Supplier</td>'+
                                                                    '<td>'+data[5].total+'</td>'+
                                                                '</tr>'+
                                                                '<tr>'+
                                                                    '<td>Tenaga Kerja</td>'+
                                                                    '<td>'+data[5].tenaga_kerja+'</td>'+
                                                                '</tr>'+
                                                            '</tbody>'+
                                                        '</table>'+
                                                    '</a>'+
                                                '</li>'+
                                            '</ul>'+
                                        '</li>'+
                                    '</ul>'+
                                '</li>'+
                            '</ul>'+
                        '</li>'+
                    '</ul>'+
                '</li>'+
            '</ul>';


            $('.komponen_right').html(element);
        }

    }

    $( document ).ready(function() {
        PohonIndustri.init();
    });

</script>


@endpush
