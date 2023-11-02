<p>APM : {{ \Str::upper($data['apm']['nama_perusahaan_apm']) }}</p>
<p>Supplier : {{ \Str::upper($data['supplier']['nama_perusahaan_supplier']) }}</p>
<p>
    Model : {{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}
</p>


<table>
    <thead>
        <tr>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">No</th>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Data</th>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center; width:20%">Nama Komponen</th>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center; width:20%">Nama Komponen Aktual</th>
            <th colspan="{{ count($data['bulan']['2021']) }}" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Tahun 2022</th>
            <!-- <th colspan="{{ count($data['bulan']['2022']) }}" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Tahun 2023</th> -->
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Total</th>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Keterangan</th>
        </tr>
        <tr>
            @foreach($data['bulan']['2021'] as $keyBulan => $valueBulan)
                <th style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">{{ $valueBulan }}</th>
            @endforeach
            <!-- @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                <th style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">{{ $valueBulan }}</th>
            @endforeach -->
        </tr>
    </thead>
    <tbody>

        <tr>
            <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">1</td>
            <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">Produksi</td>
        </tr>
        @foreach($data['results']['productionsanddevlivery'] as $keyResult => $valueResult)
            <tr>
                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center">{{ $valueResult['component_name'] }}</td>
            </tr>
            @foreach($valueResult['data'] as $keyData => $valueData)
                <tr>
                    <td>{{ $valueResult['data'][$keyData]['actual_component_name'] }}</td>

                    @foreach($data['bulan']['2021'] as $keyBulan => $valueBulan)
                        <td>{{ !empty($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2021']) ? number_format($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2021'],0,'.','.') : '' }}</td>
                    @endforeach
                    <!-- @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                        <td>{{ !empty($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2022']) ? number_format($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2022'],0,'.','.') : '' }}</td>
                    @endforeach -->

                    <td>{{ $valueResult['data'][$keyData]['produksi']['total'] }}</td>
                    <td>-</td>
                </tr>
            @endforeach
        @endforeach
        <tr>
            <td colspan="100" style="background-color:#5B9BD5;"></td>
        </tr>

        <tr>
            <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">2</td>
            <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">Delivery</td>
        </tr>

        @foreach($data['results']['productionsanddevlivery'] as $keyResult => $valueResult)
            <tr>
                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center">{{ $valueResult['component_name'] }}</td>
            </tr>
            @foreach($valueResult['data'] as $keyData => $valueData)
                <tr>
                    <td>{{ $valueResult['data'][$keyData]['actual_component_name'] }}</td>

                    @foreach($data['bulan']['2021'] as $keyBulan => $valueBulan)
                        <td>{{ !empty($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2021']) ? number_format($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2021'],0,'.','.') : '' }}</td>
                    @endforeach

                    <!-- @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                        <td>{{ !empty($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2022']) ? number_format($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2022'],0,'.','.') : '' }}</td>
                    @endforeach -->

                    <td>{{ $valueResult['data'][$keyData]['delivery']['total'] }}</td>
                    <td>-</td>
                </tr>
            @endforeach
        @endforeach

        <tr>
            <td colspan="100" style="background-color:#5B9BD5;"></td>
        </tr>
        <tr>
            <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">3</td>
            <td rowspan="{{ ($data['results']['totals'] + count($data['results']['productionsanddevlivery'])) + 1 }}" style="vertical-align:middle; text-align:center">Stock</td>
        </tr>


        @foreach($data['results']['productionsanddevlivery'] as $keyResult => $valueResult)
            <tr>
                <td rowspan="{{ count($valueResult['data'])+1 }}" style="vertical-align:middle; text-align:center">{{ $valueResult['component_name'] }}</td>
            </tr>
            @foreach($valueResult['data'] as $keyData => $valueData)
                <tr>
                    <td>{{ $valueResult['data'][$keyData]['actual_component_name'] }}</td>

                    @foreach($data['bulan']['2021'] as $keyBulan => $valueBulan)
                        <td>{{ !empty($valueResult['data'][$keyData]['dataStock'][$valueBulan]['2021']) ? $valueResult['data'][$keyData]['dataStock'][$valueBulan]['2021'] : '' }}</td>
                    @endforeach

                    <!-- @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                        <td>{{ !empty($valueResult['data'][$keyData]['dataStock'][$valueBulan]['2022']) ? $valueResult['data'][$keyData]['dataStock'][$valueBulan]['2022'] : '' }}</td>
                    @endforeach -->

                    <td></td>
                    <td>-</td>
                </tr>
            @endforeach
        @endforeach
        <tr>
            <td colspan="100" style="background-color:#5B9BD5;"></td>
        </tr>

        <tr>
            <td style="vertical-align:middle; text-align:center">4</td>
            <td colspan="3" style="vertical-align:middle; text-align:center">Jumlah Karyawan</td>
            @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                <td>{{ $data['dataKaryawan']['2022'][$valueBulan] }}</td>
            @endforeach
            <!-- @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                <td>{{ $data['dataKaryawan']['2022'][$valueBulan] }}</td>
            @endforeach -->
            <td></td>
            <td></td>
        </tr>
    </tbody>

</table>