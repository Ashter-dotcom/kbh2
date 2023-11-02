<style>
    .text-right {
        text-align: right;
        margin-top: 20px; /* Adjust the margin as needed */
    }
</style>

@for ($i = 0; $i < count($periodeTahun); $i++)
    <input id="{{$i}}[produksi]" type="hidden" name="{{$i}}[supplier_id]" value="{{$supplier->id}}">
    <input id="{{$i}}[produksi]" type="hidden" name="{{$i}}[bulan]" value="{{$periodeTahun[$i]['bulan']}}">
    <input id="{{$i}}[produksi]" type="hidden" name="{{$i}}[tahun]" value="{{$periodeTahun[$i]['tahun']}}">
    <input id="{{$i}}[produksi]" type="hidden" name="{{$i}}[kondisi]" value="{{$kondisi}}">
@endfor
<div class="container-fluid card shadow">
    <a href="#dataProduksi" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataProduksi">
        <b>Data Produksi (Unit)</b>
    </a>
    <div class="collapse show" id="dataProduksi" data-parent="#accordion">
        <div class="text-right">
                <button id="confidential-button" class="btn btn-danger" type="button">Confidential</button>
        </div>  
        <div class="card-body">
            <div class="form-row" id="myForm">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($supplier, $bulan, $tahun, $kondisi) {
                            return ($val['supplier_id'] == $supplier->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[jumlah_produksi]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[jumlah_produksi]" type="number" name="{{$i}}[jumlah_produksi]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['jumlah_produksi'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataPenjualanEkspor" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPenjualanEkspor">
        <b>Data Penjualan Ekspor (USD)</b>
    </a>
    <div class="collapse" id="dataPenjualanEkspor" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button2" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm2">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($supplier, $bulan, $tahun, $kondisi) {
                            return ($val['supplier_id'] == $supplier->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[jumlah_penjualan_ekspor]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[jumlah_penjualan_ekspor]" type="number" name="{{$i}}[jumlah_penjualan_ekspor]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['jumlah_penjualan_ekspor'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataPenjualanDomestik" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPenjualanDomestik">
        <b>Data Penjualan Domestik (IDR)</b>
    </a>
    <div class="collapse" id="dataPenjualanDomestik" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button3" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row"  id="myForm3">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($supplier, $bulan, $tahun, $kondisi) {
                            return ($val['supplier_id'] == $supplier->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[jumlah_penjualan_domestik]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[jumlah_penjualan_domestik]" type="number" name="{{$i}}[jumlah_penjualan_domestik]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['jumlah_penjualan_domestik'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataTenagaKerja" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataTenagaKerja">
        <b>Data Tenaga Kerja (Orang)</b>
    </a>
    <div class="collapse" id="dataTenagaKerja" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button4" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm4">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($supplier, $bulan, $tahun, $kondisi) {
                            return ($val['supplier_id'] == $supplier->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[jumlah_tenaga_kerja]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[jumlah_tenaga_kerja]" type="number" name="{{$i}}[jumlah_tenaga_kerja]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['jumlah_tenaga_kerja'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataPph21" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPph21">
        <b>PPh Pasal 21 (IDR)</b>
    </a>
    <div class="collapse" id="dataPph21" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button5" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row"  id="myForm5">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($supplier, $bulan, $tahun, $kondisi) {
                            return ($val['supplier_id'] == $supplier->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[pph_21]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[pph_21]" type="number" name="{{$i}}[pph_21]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['pph_21'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataPph25" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPph25">
        <b>PPh Badan Pasal 25/29 (IDR)</b>
    </a>
    <div class="collapse" id="dataPph25" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button6" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm6">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($supplier, $bulan, $tahun, $kondisi) {
                            return ($val['supplier_id'] == $supplier->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[pph_25]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[pph_25]" type="number" name="{{$i}}[pph_25]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['pph_25'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataKapasitasProduksi" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataKapasitasProduksi">
        <b>Kapasitas Produksi Terpasang (Unit)</b>
    </a>
    <div class="collapse" id="dataKapasitasProduksi" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button7" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm7">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($supplier, $bulan, $tahun, $kondisi) {
                            return ($val['supplier_id'] == $supplier->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[kapasitas_produksi]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[kapasitas_produksi]" type="number" name="{{$i}}[kapasitas_produksi]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['kapasitas_produksi'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataTingkatUtility" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataTingkatUtility">
        <b>Tingkat Utility (%)</b>
    </a>
    <div class="collapse" id="dataTingkatUtility" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button8" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm8">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($supplier, $bulan, $tahun, $kondisi) {
                            return ($val['supplier_id'] == $supplier->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[tingkat_utilitas]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[tingkat_utilitas]" type="number" step="any" name="{{$i}}[tingkat_utilitas]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['tingkat_utilitas'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataInvestasiBaru" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataInvestasiBaru">
        <b>Investasi Baru (IDR)</b>
    </a>
    <div class="collapse" id="dataInvestasiBaru" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button9" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm9">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($supplier, $bulan, $tahun, $kondisi) {
                            return ($val['supplier_id'] == $supplier->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[investasi_baru]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[investasi_baru]" type="number" name="{{$i}}[investasi_baru]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['investasi_baru'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="row container col-md-12">
    <div class="col-md-6">
        <a href="{{ route('profil-perusahaan-supplier-index') }}" class="btn btn-outline-secondary btn-block shadow"><i class="fa fa-times"></i> Batal</a>
    </div>
    <div class="col-md-6">
        <button type="submit" class="btn btn-dark btn-block shadow"><i class="fa fa-save"></i> Simpan</button>
    </div>
</div><br /><br />

<!-- Add the JavaScript and jQuery libraries if not already included in your project -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Initially, enable all form elements
        enableFormElements();

        // Click event handler for the "Confidential" button
        $('#confidential-button').click(function() {
            toggleFormElements($(this), '#myForm');
        });

        // Repeat the above click event handler for other buttons
        $('#confidential-button2').click(function() {
            toggleFormElements($(this), '#myForm2');
        });

        // Add more click event handlers for other buttons as needed
        // ...
        $('#confidential-button3').click(function() {
            toggleFormElements($(this), '#myForm3');
        });
        $('#confidential-button4').click(function() {
            toggleFormElements($(this), '#myForm4');
        });
        $('#confidential-button5').click(function() {
            toggleFormElements($(this), '#myForm5');
        });
        $('#confidential-button6').click(function() {
            toggleFormElements($(this), '#myForm6');
        });
        $('#confidential-button7').click(function() {
            toggleFormElements($(this), '#myForm7');
        });
        $('#confidential-button8').click(function() {
            toggleFormElements($(this), '#myForm8');
        });
        $('#confidential-button9').click(function() {
            toggleFormElements($(this), '#myForm9');
        });

        function toggleFormElements(button, formId) {
            // Toggle the disabled attribute for form elements inside the specified form
            $(formId + ' :input:not(.exclude)').prop('disabled', function(i, disabled) {
                return !disabled;
            });

            // Toggle the button text
            button.text(function(i, text) {
                return text === 'Confidential' ? 'Confidential' : 'Confidential';
            });
        }

        function enableFormElements() {
            // Enable all form elements except those with the class "exclude"
            $('#myForm :input:not(.exclude)').prop('disabled', false);
        }
    });
</script>