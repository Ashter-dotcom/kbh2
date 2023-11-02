<!-- <p>APM : {{ \Str::upper($data['apm']['nama_perusahaan_apm']) }}</p> -->
<p>{{ \Str::upper($data['supplier']['nama_perusahaan_supplier']) }}</p>
<!-- <p>
    Model : {{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}
</p> -->

<table>
    <thead>
        <tr>
            <th colspan="2"></th>
            <th colspan="1" style=" text-align:center; vertical-align: middle;">jam</th>
            <th colspan="1" style=" text-align:center; vertical-align: middle;">menit</th>
            <th colspan="1" style=" background-color:rgb(143, 146, 148); text-align:center; vertical-align: middle;">s/d</th>
            <th colspan="1" style=" text-align:center; vertical-align: middle;">jam</th>
            <th colspan="1" style=" text-align:center; vertical-align: middle;">menit</th>
            <th colspan="3" style=" text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style=" text-align:center; vertical-align: middle;">Total (Menit)</th>
            <th colspan="1" style=" text-align:center; vertical-align: middle;">Total (Detik)</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th rowspan="3" style="text-align:center; vertical-align: middle;">Jam Kerja/Hari</th>
            <th colspan="1" style="text-align:center; vertical-align: middle;">a. Shift 1</th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th rowspan="3" style="background-color: rgb(143, 146, 148); text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="1" style="text-align:center; vertical-align: middle;">b. Shift 2</th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="1" style="text-align:center; vertical-align: middle;">c. Shift 3</th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
        <th colspan="12" style="text-align:center; vertical-align: middle;"></th>
        <tr>
            <th rowspan="12" style="text-align:center; vertical-align: middle;">Jam Istirahat/Hari</th>
            <th rowspan="4" style="text-align:center; vertical-align: middle;">a. Shift 1</th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th rowspan="3" style="background-color: rgb(143, 146, 148); text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #AFEEEE; text-align:center; vertical-align: middle;"></th>
        </tr>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #AFEEEE; text-align:center; vertical-align: middle;"></th>
        <tr>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #AFEEEE; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="9" style="text-align:right; vertical-align: middle;">TOTAL</th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th rowspan="4" style="text-align:center; vertical-align: middle;">b. Shift 2</th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th rowspan="3" style="background-color: rgb(143, 146, 148); text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #AFEEEE; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #AFEEEE; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #AFEEEE; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="9" style="text-align:right; vertical-align: middle;">TOTAL</th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th rowspan="4" style="text-align:center; vertical-align: middle;">c. Shift 3</th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th rowspan="3" style="background-color: rgb(143, 146, 148); text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #AFEEEE; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #AFEEEE; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #AFEEEE; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="9" style="text-align:right; vertical-align: middle;">TOTAL</th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
        <th colspan="12" style="text-align:center; vertical-align: middle;"></th>
        <tr>
            <th colspan="11" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;">(DETIK)</th>
        </tr>
        <tr>
            <th rowspan="3" style="text-align:center; vertical-align: middle;">Efektif Jam Kerja/Hari</th>
            <th colspan="1" style="text-align:center; vertical-align: middle;">a. Shift 1</th>
            <th colspan="9" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="1" style="text-align:center; vertical-align: middle;">b. Shift 2</th>
            <th colspan="9" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="1" style="text-align:center; vertical-align: middle;">c. Shift 3</th>
            <th colspan="9" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="7" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="4" style="text-align:right; vertical-align: middle;">TOTAL</th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
        </tr>
        <th colspan="12" style="text-align:center; vertical-align: middle;"></th>
        <tr>
            <th colspan="11" style="text-align:center; vertical-align: middle;">Hari Kerja/Minggu</th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
        </tr>
        <th colspan="12" style="text-align:center; vertical-align: middle;"></th>
        <tr>
            <th colspan="11" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;">(DETIK)</th>
        </tr>
        <tr>
            <th colspan="11" style="text-align:center; vertical-align: middle;">Total jam kerja setahun</th>
            <th colspan="1" style="background-color: #FFFF00; text-align:center; vertical-align: middle;"></th>
        </tr>
            <th colspan="12" style="text-align:center; vertical-align: middle;"></th>
        <tr>
            <th colspan="11" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="1" style="text-align:center; vertical-align: middle;">(DETIK)</th>
        </tr>
        <tr>
            <th colspan="11" style="text-align:center; vertical-align: middle;">Waktu proses per komponen</th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
        </tr>
        <th colspan="12" style="text-align:center; vertical-align: middle;"></th>
        <tr>
            <th colspan="11" style="text-align:center; vertical-align: middle;">Jumlah Mesin</th>
            <th colspan="1" style="background-color: #EE82EE; text-align:center; vertical-align: middle;"></th>
        </tr>
        <th colspan="12" style="text-align:center; vertical-align: middle;"></th>
        <tr>
            <th colspan="11" style="text-align:center; vertical-align: middle;">Kapasitas maksimum per tahun (PCS)</th>
            <th colspan="1" style="background-color: #FFDEAD; text-align:center; vertical-align: middle;"></th>
        </tr>
        <th colspan="12" style="text-align:center; vertical-align: middle;"></th>
        <tr>
            <th colspan="8" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="3" style="text-align:left; vertical-align: middle;">Produksi 1 Hari Kerja</th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="8" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="3" style="text-align:left; vertical-align: middle;">Produksi 22 Hari Kerja (1 Bulan)</th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
        </tr>
        <tr>
            <th colspan="8" style="text-align:center; vertical-align: middle;"></th>
            <th colspan="3" style="text-align:left; vertical-align: middle;">Produksi 1 Tahun</th>
            <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
        </tr>
    </tbody>

</table>
