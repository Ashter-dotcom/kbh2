<p>
REALISASI INVESTASI
</p>
<p>
    {{ $data['apm'] }}
</p>
<p>
    Model : {{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}
</p>
<p>
    {{ $data['periode'] }}
</p>
<table>
    <thead>
        <tr>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left;">No</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left;">Tahun</th>
            <th colspan="1" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left;">Investasi (Rp)</th>
            <th colspan="1" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left;">Kegiatan Manufaktur</th>
            <th colspan="1" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left;">Investasi (Rp)</th>
            <th colspan="1" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left;">Kegiatan Manufaktur</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Data Pendukung</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Keterangan</th>
        </tr>
        <tr>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Rencana</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Rencana</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Realisasi</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; float:left; width:30%">Realisasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['results']['data'] as $keyResult => $valueResult)
            <tr>
                <td>{{ $data['no']++ }}</td>
                <td>{{ $valueResult['kelompok'] }}</td>
                <td>{{ $valueResult['kategori'] }}</td>
                <td>{{ implode(' , ',$valueResult['actual_component_name']) }}</td>
                <td>{{ implode(' , ',$valueResult['supplier']) }}</td>
                <td style="text-align:center;">-</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6" style="font-weight:bold"></td>
            <td style="text-align:center">{{ !empty($data['results']['total_supplier']) ? $data['results']['total_supplier'] : '' }}</td>
            <td></td>
        </tr>
    </tbody>
</table>
