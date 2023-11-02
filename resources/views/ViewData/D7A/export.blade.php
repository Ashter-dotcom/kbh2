<p>
REALISASI DATA PRODUKSI UNIT
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
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">No</th>
            <th colspan="7" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:50%">Produk</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; middle; width:30%;">NIK</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; middle; width:30%;">Keterangan</th>
        </tr>
        <tr>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; middle; width:30%;">Grouping Hasil Produksi Berdasarkan IUI</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; middle; width:30%;">Merek</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; middle; width:30%;">Jenis</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; middle; width:30%;">Model</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; middle; width:30%;">Tipe</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; middle; width:30%;">Varian</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; middle; width:30%;">Kapasitas Silinder</th>
        </tr>
    </thead>
    <tbody>


        @foreach($results['data'] as $result)
            <tr>
                <td>1</td>
                <td>Pembuatan / perakitan kendaraan bermotor roda empat</td>
                <td>{{ !empty($result->merek) ? $result->merek : '' }}</td>
                <td>{{ !empty($result->jenis_kbm) ? $result->jenis_kbm : '' }}</td>
                <td>{{ !empty($result->nama_model) ? $result->nama_model : '' }}</td>
                <td>{{ !empty($result->nama_tipe) ? $result->nama_tipe : '' }}</td>
                <td>{{ !empty($result->nama_varian) ? $result->nama_varian : '' }}</td>
                <td>{{ !empty($result->nama_kapasitas_silinder) ? $result->nama_kapasitas_silinder : '' }}</td>
                <td>{{ !empty($result->nik) ? $result->nik : '' }}</td>
                <td style="text-align:center;">-</td>
            </tr>
        @endforeach
    </tbody>
</table>
