<style>
    .text-right {
        text-align: right;
        margin-top: 20px; /* Adjust the margin as needed */
    }
</style>

@for ($i = 0; $i < count($periodeTahun); $i++)
    <input id="{{$i}}[produksi]" type="hidden" name="{{$i}}[apm_id]" value="{{$apm->id}}">
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
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[jumlah_produksi]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[jumlah_produksi]" type="number" name="{{$i}}[jumlah_produksi]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['jumlah_produksi'] : 0 }}" >
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
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
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
            <div class="form-row" id="myForm3">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
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
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
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
    <a href="#dataPpnImport" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPpnImport">
        <b>PPN Import (IDR)</b>
    </a>
    <div class="collapse" id="dataPpnImport" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button5" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm5">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[ppn_impor]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[ppn_impor]" type="number" name="{{$i}}[ppn_impor]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['ppn_impor'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataPpnSpt" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPpnSpt">
        <b>PPN Netto Sesuai SPT (IDR)</b>
    </a>
    <div class="collapse" id="dataPpnSpt" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button6" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm6">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[ppn_spt]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[ppn_spt]" type="number" name="{{$i}}[ppn_spt]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['ppn_spt'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataPpnBm" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPpnBm">
        <b>PPN BM Penjualan (IDR)</b>
    </a>
    <div class="collapse" id="dataPpnBm" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button7" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm7">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[ppn_bm]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[ppn_bm]" type="number" name="{{$i}}[ppn_bm]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['ppn_bm'] : 0 }}">
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
            <button id="confidential-button8" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm8">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
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
    <a href="#dataPph22" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPph22">
        <b>PPh Pasal 22 (IDR)</b>
    </a>
    <div class="collapse" id="dataPph22" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button9" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm9">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[pph_22]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[pph_22]" type="number" name="{{$i}}[pph_22]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['pph_22'] : 0 }}">
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div><br />

<div class="container-fluid card shadow">
    <a href="#dataPph23" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPph23">
        <b>PPh Pasal 23 (IDR)</b>
    </a>
    <div class="collapse" id="dataPph23" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button10" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm10">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[pph_23]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[pph_23]" type="number" name="{{$i}}[pph_23]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['pph_23'] : 0 }}">
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
            <button id="confidential-button11" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm11">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
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
    <a href="#dataPph4" class="card-header text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="dataPph4">
        <b>PPh Pasal 4 (IDR)</b>
    </a>
    <div class="collapse" id="dataPph4" data-parent="#accordion">
    <div class="text-right">
            <button id="confidential-button12" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm12">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
                        });
                    ?>
                    <div class="form-group col-md-2 col-xs-12 col-sm-12 col-lg-2">
                        <label for="{{$i}}[pph_4_2]">{{ date('F', mktime(0, 0, 0, $periodeTahun[$i]['bulan'], 10)); }} {{ $periodeTahun[$i]['tahun'] }}</label>
                        <input id="{{$i}}[pph_4_2]" type="number" name="{{$i}}[pph_4_2]" class="form-control" value="{{ (array_values($key)) ? array_values($key)[0]['pph_4_2'] : 0 }}">
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
            <button id="confidential-button13" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm13">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
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
            <button id="confidential-button14" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm14">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
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
            <button id="confidential-button15" class="btn btn-danger" type="button">Confidential</button>
    </div>
        <div class="card-body">
            <div class="form-row" id="myForm15">
                @for ($i = 0; $i < count($periodeTahun); $i++)
                    <?php
                        $bulan = $periodeTahun[$i]['bulan'];
                        $tahun = $periodeTahun[$i]['tahun'];
                        $key =  array_filter(json_decode(json_encode($data), true), function ($val) use ($apm, $bulan, $tahun, $kondisi) {
                            return ($val['apm_id'] == $apm->id and $val['bulan'] == $bulan and $val['tahun'] == $tahun and $val['kondisi'] == $kondisi);
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
    <div class="col-md-12">
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
        $('#confidential-button10').click(function() {
            toggleFormElements($(this), '#myForm10');
        });
        $('#confidential-button11').click(function() {
            toggleFormElements($(this), '#myForm11');
        });
        $('#confidential-button12').click(function() {
            toggleFormElements($(this), '#myForm12');
        });
        $('#confidential-button13').click(function() {
            toggleFormElements($(this), '#myForm13');
        });
        $('#confidential-button14').click(function() {
            toggleFormElements($(this), '#myForm14');
        });
        $('#confidential-button15').click(function() {
            toggleFormElements($(this), '#myForm15');
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
