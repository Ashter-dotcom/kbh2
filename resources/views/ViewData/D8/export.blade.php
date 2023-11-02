<p>APM : {{ \Str::upper($data['apm']['nama_perusahaan_apm']) }}</p>
<p>Supplier : {{ \Str::upper($data['supplier']['nama_perusahaan_supplier']) }}</p>
<p>
    Model : {{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}
</p>


<table>
    <thead>
        <tr>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">No</th>
            <th colspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center; width:20%">Produk</th>
            <th colspan="3" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center; width:20%">Panduan Rencana Tahapan Manufaktur Sesuai PerMenPerin</th>
            <th colspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center; width:20%">Rencana Tahapan Manufaktur</th>
            <th colspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center; width:20%">Realisasi Tahapan Manufaktur</th>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Nama Perusahaan</th>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Local/Impor</th>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Kondisi</th>
            <th rowspan="2" style="border:1px solid #000000; background-color:#56565c; text-align:center; vertical-align:middle; text-align:center">Keterangan</th>
        </tr>
        <tr>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Kelompok Barang</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Nama Komponen Aktual</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Nama Komponen</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Tahun</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Kondisi</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Tahun</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Kondisi</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Tahun</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Kondisi</th>
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
                    @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                        <td>{{ !empty($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2022']) ? number_format($valueResult['data'][$keyData]['produksi']['month'][$valueBulan]['2022'],0,'.','.') : '' }}</td>
                    @endforeach

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

                    @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                        <td>{{ !empty($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2022']) ? number_format($valueResult['data'][$keyData]['delivery']['month'][$valueBulan]['2022'],0,'.','.') : '' }}</td>
                    @endforeach

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

                    @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                        <td>{{ !empty($valueResult['data'][$keyData]['dataStock'][$valueBulan]['2022']) ? $valueResult['data'][$keyData]['dataStock'][$valueBulan]['2022'] : '' }}</td>
                    @endforeach

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
            @foreach($data['bulan']['2021'] as $keyBulan => $valueBulan)
                <td>{{ $data['dataKaryawan']['2021'][$valueBulan] }}</td>
            @endforeach
            @foreach($data['bulan']['2022'] as $keyBulan => $valueBulan)
                <td>{{ $data['dataKaryawan']['2022'][$valueBulan] }}</td>
            @endforeach
            <td></td>
            <td></td>
        </tr>
    </tbody>

</table>
