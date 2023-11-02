<p>
REALISASI DATA PENJUALAN UNIT
</p>
<p>
    {{ $data['apm'] }}
</p>
<p>
    {{ $data['periode'] }}
</p>

<table class="table table-bordered table-striped table-responsi">
    <thead>
        <tr>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">No</th>
            <th colspan="8" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Produk</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Customer</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Harga Per Unit</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Nomor Faktur Kendaraan</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Keterangan</th>
        </tr>
        <tr>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Grouping Hasil Produksi Berdasarkan IUI</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%">Merek</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Jenis</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Model</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Tipe</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Varian</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Kapasitas Silinder</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">NIK</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['results'] as $result)
            <tr>
                <td>{{ $data['no']++ }}</td>
                <td>{{ $result['grouping_berdasarkan_uiu'] }}</td>
                <td>{{ $result['merek'] }}</td>
                <td>{{ $result['jenis'] }}</td>
                <td>{{ $result['model'] }}</td>
                <td>{{ $result['tipe'] }}</td>
                <td>{{ $result['varian'] }}</td>
                <td>{{ $result['kapasitas_silinder'] }}</td>
                <td>{!! implode(",",$result['nik']) !!}</td>
                <td>{{ implode(', ',$result['customer']) }}</td>
                <td>{{ implode(', ',$result['harga']) }}</td>
                <td>{{ $result['total_nik'] }}</td>
                <td style="text-align:center;">-</td>
            </tr>
        @endforeach
    </tbody>
</table>
