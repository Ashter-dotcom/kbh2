<p class="h2 text-center font-weight-bold">
    REALISASI TAHAPAN MANUFAKTUR DAN PENGGUNAAN KOMPONEN LAINNYA
    </p>
<p class="h2 text-center font-weight-bold">
    {{ \Str::upper($data['apm']->nama_perusahaan_apm) }}
</p>
<!-- <p>
    Model :{{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}
</p> -->
<!-- <p>
    {{ $data['periode'] }}
</p> -->

<table class="table table-bordered table-striped table-responsi">
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
