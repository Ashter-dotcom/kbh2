<p>
    RENCANA INVESTASI
</p>
<p>
    {{ $data['apm'] }}
</p>
<p>
    {{ $data['periode'] }}
</p>

<table>
    <thead>
        <tr>
            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF;">No</th>
            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF;">tahun</th>
            <th colspan="1" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF;">Investasi (Rp)</th>
            <th colspan="1" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF;">Kegiatan Mufaktur</th>
            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF; width:30%">Data Pendukung</th>
            <th rowspan="2" style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF; width:30%">Keterangan</th>
        </tr>

        <tr>
            <th style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF; width:50%;">Rencana</th>
            <th style="background-color:#56565c; text-align:center; vertical-align: middle; border:1pz solid #FFFFFF; color:#FFFFFF; width:30%;">Rencana</th>
        </tr>
    </thead>
    <tbody>
        <!-- @foreach($data['results']['data'] as $key => $dataKey)
            <tr>
                <td>{{ $data['results']['no']++ }}</td>
                <td>2022</td>
                <td>{{ $data['results']['data'][$key]['report']['merek'] }}</td>
                <td>{{ $data['results']['data'][$key]['report']['jenis'] }}</td>
                <td>{{ $data['results']['data'][$key]['report']['model'] }}</td>
                <td>{{ $data['results']['data'][$key]['report']['tipe'] }}</td>
            </tr>
        @endforeach -->
    </tbody>
</table>