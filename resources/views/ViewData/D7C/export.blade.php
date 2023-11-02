<p>
    STOCK UNIT PER END {{ $data['periode_akhir'] }}
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
        </tr>
        <tr>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:50%;">Grouping Hasil Produksi Berdasarkan IUI</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:40%;">Merek</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:40%;">Jenis</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:40%;">Model</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:40%;">Tipe</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:40%;">Varian</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:40%;">Kapasitas Silinder</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:40%;">NIK</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['results'] as $result)
            <tr>
                <td>{{ $result['no'] }}</td>
                <td>{{ $result['grouping_berdasarkan_uiu'] }}</td>
                <td>{{ $result['merek'] }}</td>
                <td>{{ $result['jenis'] }}</td>
                <td>{{ $result['model'] }}</td>
                <td>{{ $result['tipe'] }}</td>
                <td>{{ $result['varian'] }}</td>
                <td>{{ $result['kapasitas_silinder'] }}</td>
                <td>{{ implode(', ',$result['nik']) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
