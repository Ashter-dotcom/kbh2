<p class="h2 text-center font-weight-bold">
    RENCANA TAHAPAN MANUFAKTUR DAN PENGGUNAAN KOMPONEN LAINNYA
    </p>
<p class="h2 text-center font-weight-bold">
    {{ \Str::upper($data['apm']->nama_perusahaan_apm) }}
</p>
<p>
    Model :{{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}
</p>
<!-- <p>
    {{ $data['periode'] }}
</p> -->

<table class="table table-bordered table-striped table-responsi">
    <thead>
        <tr>
            <th class="tg-uzvj" rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">No</th>
            <th class="tg-uzvj" colspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Produk</th>
            <th class="tg-wa1i" colspan="3" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Panduan Rencana Tahapan Manufaktur Sesuai PerMenPerin</th>
            <th class="tg-uzvj" colspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Rencana Tahapan Manufaktur</th>
            <th class="tg-uzvj" rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Nama Perusahaan</th>
            <th class="tg-uzvj" rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Local / import</th>
            <th class="tg-uzvj" rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Kondisi</th>
            <th class="tg-uzvj" rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Keterangan</th>
        </tr>
        <tr>
            <th class="tg-wa1i" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Kelompok Barang</th>
            <th class="tg-wa1i" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Nama Komponen Aktual</th>
            <th class="tg-wa1i" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Nama Komponen</th>
            <th class="tg-wa1i" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Tahun</th>
            <th class="tg-wa1i" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Kondisi</th>
            <th class="tg-wa1i" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Tahun</th>
            <th class="tg-wa1i" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Kondisi</th>
        </tr>
    </thead>
    <tbody>


                        @php
                            $presentase = '0 %';
                            $totalComponent = [];
                            $totalPresentase = [];
                            $totalDataKebutuhan = [];
                            $totalDataPembelian = [];
                            $countTotalPresentase = [];
                            $totalRealisasiPembelian = [];

                        @endphp

                        @foreach($data['results']['data'] as $result)

                            @foreach($result['data']['pembelian'] as $keyPembelian => $pembelian)
                                @php
                                    $totalPembelian = 0;
                                    array_push($totalComponent, $keyPembelian);
                                @endphp
                                @if (empty($data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier']))
                                    @elseif (strtolower(preg_replace('/\s+/', '', $data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier'])) != 'tidakdigunakan')
                                    <tr>
                                        <td>{{ $data['results']['no']++}}</td>
                                        <td>{{ $result['kelompok'] }}</td>
                                        <td>{{ $result['kategori'] }}</td>
                                        <td>{{ $result['kategori'] }}</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">x</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">x</td>
                                        <td style="text-align:center;">{{ !empty($data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier']) ? $data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier'] : 'Tidak Digunakan' }}</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                    </tr>
                                @endif
                            @endforeach

                        @endforeach
                        <tfoot>
                            <tr>

                            </tr>
                        </tfoot>
    </tbody>
</table>
