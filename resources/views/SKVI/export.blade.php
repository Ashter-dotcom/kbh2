<table>
    <thead>

        <tr>
            <th colspan="8" style="text-align:center; font-weight:bold; width:100%; border-top:1px solid #ffffff; border-right:1px solid #ffffff;  border-left:1px solid #ffffff;">
                <p style="font-size:14px;float: right;margin-right:50px;box-shadow: 0 0 0 1px black;padding: 10px;">{{ request()->nomor_skvi }}</p>
                <br>
                <p style="font-size:14px;">SURAT KETERANGAN VERIFIKASI INDUSTRI</p>
                <br>
                <p style="font-size:14px;">PERMOHONAN PENETAPAN BERMOTOR RODA EMPAT LISTRIK HYBRID (HYBRID ELECTRIC VEHICLE)</p>
                <br>
                <p style="font-size:14px;">DALAM RANGKA PELAKSANAAN PROGRAM KENDARAAN BERMOTOR RODA EMPAT </p>
                <br>
                <p style="font-size:14px;">EMISI KARBON RENDAH (LCEV)</p>
                <br>
                <p style="font-size:14px;">Berdasarkan:</p>
                <br>
                <p style="font-size:14px;">1. Peraturan Pemerintah Republik Indonesia  Nomor : 73 Tahun 2019 Jo 74 Tahun 2021</p>
                <br>
                <p style="font-size:14px;">2. Peraturan Menteri Perindustrian Republik Indonesia  Nomor : 36 Tahun 2021</p>
                <br>
                <p style="font-size:14px;">3. Keputusan Direktur Jenderal Industri Logam, Mesin, Alat Transportasi, Dan Elektronika Nomor : 20 Tahun 2022</p>
                <br>
                <br>
            </th>
        </tr>

        <tr>
            <th colspan="8" style="text-align:center; font-weight:bold; width:100%; border-right:1px solid #ffffff;  border-left:1px solid #ffffff;">
                <br>
                <p style="font-size:14px;">DIBERIKAN KEPADA</p>
                <p style="font-size:20px;">{{ !empty($data['apmInformation']->nama_perusahaan_apm) ? $data['apmInformation']->nama_perusahaan_apm : '' }}</p>
            </th>
        </tr>

        <tr>
            <th colspan="8" style="font-weight:bold; width:100%; border-top:1px solid #ffffff; border-right:1px solid #ffffff;  border-left:1px solid #ffffff;">
                <p style="font-size:14px;">
                    Alamat Kantor : {!! !empty($data['apmInformation']->alamat_kantor) ? $data['apmInformation']->alamat_kantor : '' !!}
                </p>
                <br>
                <p style="font-size:14px;">
                    Alamat Pabrik : {!! !empty($data['apmInformation']->alamat_pabrik) ? str_replace(['<p>','<ol>','<ul>','<li>','</ol>','</ul>','</li>','</p>'],'<br>',$data['apmInformation']->alamat_pabrik) : '' !!}
                </p>
                <p style="font-size:14px;">
                    NPWP : {!! !empty($data['apmInformation']->npwp_perusahaan) ? $data['apmInformation']->npwp_perusahaan : '' !!}
                </p>
                <br>
            </th>

        </tr>

        <tr>
            <th colspan="8" style="text-align:center; border-top:1px solid #ffffff; font-weight:bold; width:100%; border-right:1px solid #ffffff;  border-left:1px solid #ffffff;">
                <p style="font-size:14px;">UNTUK KENDARAAN BERMOTOR RODA EMPAT LISTRIK HYBRID (HYBRID ELECTRIC VEHICLE)</p>
            </th>
        </tr>

        <tr>
            <th colspan="8" style="font-weight:bold; width:100%; border-top:1px solid #ffffff; border-right:1px solid #ffffff;  border-left:1px solid #ffffff;">
                <p style="font-size:14px;">
                    Dengan Identitas :
                </p>
                <br>
            </th>

        </tr>
        <tr>
            <th style="text-align:center; vertical-align: middle; middle; width:30%;">No</th>
            <th style="text-align:center; vertical-align: middle; middle; width:30%;">Merek</th>
            <th style="text-align:center; vertical-align: middle; middle; width:30%;">Jenis</th>
            <th style="text-align:center; vertical-align: middle; middle; width:30%;">Model</th>
            <th style="text-align:center; vertical-align: middle; middle; width:30%;">Tipe</th>
            <th style="text-align:center; vertical-align: middle; middle; width:30%;">Kapasitas Silinder</th>
        </tr>
    </thead>
    @if(!empty($data['results']['penjualan']))
        <tbody>
            @foreach($data['results']['penjualan'] as $keyJenisKbm => $valueJenisKbm)
                @foreach($valueJenisKbm as $keyMerek => $valueMerek)
                    @foreach($valueMerek as $keyModel => $valueModel)
                        @foreach($valueModel as $keyVarian => $valueVarian)
                            <tr>
                                <td>{{ $data['no']++ }} </td>
                                <td>{{ $keyMerek }}</td>
                                <td>{{ $keyJenisKbm }}</td>
                                <td>{{ $keyModel }}</td>
                                <td>{{ $valueVarian['tipe'] }}</td>
                                <td>{{ number_format($valueVarian['kapasitas_silinder'], 0, '.', '.') }}</td>

                                @if($loop->first)
                                    <td rowspan="{{ count($valueMerek[$keyModel]) }}">
                                    {{ number_format(array_sum($data['results']['dataPresentasePembelianLokal'][$keyModel]) / count($data['results']['dataPresentasePembelianLokal'][$keyModel]), 2,',',',') .'%' }}
                                    </td>
                                @endif
                                <td>{{ number_format($valueVarian['totals'], 0, '.', '.') }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
    @endif
</table>


<table>
    <tr>
        <td colspan="8" style="font-weight:bold; width:100%; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff;  border-left:1px solid #ffffff;">
            <br>
            <br>
            <p style="font-size:14px;">Telah di verifikasi dan memenuhi persyaratan sesuai dengan ketentuan yang berlaku.</p>
            <p style="font-size:14px;">Rincian hasil verifikasi sebagaimana terlampir merupakan bagian yang tidak terpisahkan dari surat keterangan verifikasi Industri ini.</p>
        </td>
    </tr>


    <tr>
        <td colspan="8" style="text-align:right; font-weight:bold; width:100%; border-bottom:1px solid #ffffff; border-right:1px solid #ffffff;  border-left:1px solid #ffffff;">
            <p style="font-size:14px;">Jakarta, {{ !empty(request()->tanggal) ?  date_bahasa(request()->tanggal) : date_bahasa(date('Y-m-d')) }}</p>
            <br>
            <p style="font-size:14px;">Manager Project</p>
            <p style="font-size:14px;">PT. Surveyor Indonesia</p>
            <br>
            <br>
            <br>
            <br>
            <p style="font-size:14px;">{{ !empty(request()->nama_pejabat) ? request()->nama_pejabat : '' }}</p>
        </td>
    </tr>
</table>
