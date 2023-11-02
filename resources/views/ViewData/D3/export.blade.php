<p>
    RENCANA PRODUKSI UNIT
</p>
<p>
    {{ $data['apm'] }}
</p>
<!-- <p>
    Model :{{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}
</p>
<p>
    {{ $data['periode'] }}
</p> -->

<table class="table table-bordered table-striped table-responsi">
    <thead>
        <tr>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">No</th>
            <th colspan="7" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Produk</th>
            <th colspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Quantity Produk</th>
            <th rowspan="2" style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle;">Keterangan</th>
        </tr>

        <tr>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Grouping Hasil Produksi Berdasarkan IUI</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Merek</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Jenis</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Model</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Tipe</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Varian</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Kapasitas Silinder (cc)</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Rencana</th>
            <th style="border: 1px solid #ffffff; color:#ffffff; background-color:#56565c; text-align:center; vertical-align: middle; width:30%;">Persediaan</th>

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

                    @foreach($data['results']['ranges']['data'] as $range)
                        @php
                            $totalDataKebutuhan[$range][] = !empty($result['data']['kebutuhan'][$range]) ? $result['data']['kebutuhan'][$range] : 0
                        @endphp
                        <td style="text-align:center;">{{ !empty($result['data']['kebutuhan'][$range]) ? number_format($result['data']['kebutuhan'][$range], 0,'.','.') : 0 }}</td>
                    @endforeach

                    <td style="text-align:center;">{{ $result['satuan'] }}</td>


                    @foreach($data['results']['ranges']['data'] as $range)
                        @php
                            $totalDataPembelian[$range][] = array_sum($pembelian['month'][$range]);
                        @endphp
                        <td style="text-align:center;">{{ number_format(array_sum($pembelian['month'][$range]),0,'.','.') }}</td>
                    @endforeach

                    <td style="text-align:center;">{{ $result['satuan'] }}</td>
                    <td style="text-align:center;">{{ !empty($data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier']) ? $data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier'] : '' }}</td>

                    @php
                        array_push($totalRealisasiPembelian, array_sum($pembelian['total']));
                    @endphp

                    <td>{{ number_format(array_sum($pembelian['total']),0,'.','.') }}</td>

                    @if(!empty(array_sum($pembelian['total'])) && !empty(array_sum($result['data']['kebutuhan'])))
                        <?php
                            $valuePersentase = (array_sum($pembelian['total']) / array_sum($result['data']['kebutuhan'])) * 100;
                            $valueAkhir = ($valuePersentase >= 100) ? 100 : $valuePersentase;

                            array_push($totalPresentase, $valueAkhir);
                        ?>
                        <td style="text-align:center;">{{ number_format($valueAkhir,2,',','.') }} %</td>
                    @else
                        <td style="text-align:center;">0 %</td>
                    @endif
                    @if($loop->first)

                        @php
                            $totalKebutuhan = array_sum($result['data']['kebutuhan']);
                        @endphp

                        <td  rowspan="{{ count($result['data']['pembelian']) }}" style="text-align:center;">
                            @foreach($result['data']['pembelian'] as $keyPembelian => $valuePembelian)
                                @if(!empty(array_sum($valuePembelian['total'])) && !empty(array_sum($result['data']['kebutuhan'])))
                                    @php
                                        $totalPembelian += array_sum($valuePembelian['total']);
                                    @endphp
                                @endif

                            @endforeach

                            @php
                                $presentaseMerging = !empty($totalKebutuhan) ? (($totalPembelian / $totalKebutuhan) * 100) > 100 ? 100 : ($totalPembelian / $totalKebutuhan) * 100 : 0;

                                if(empty($data['results']['dataSupplier'][$keyPembelian]['supplier_id'])){

                                }elseif(strtolower(preg_replace('/\s+/', '', $data['results']['dataSupplier'][$keyPembelian]['nama_perusahaan_supplier'])) != 'tidakdigunakan') {
                                    array_push($countTotalPresentase, $presentaseMerging);
                                }
                            @endphp

                            {{ number_format($presentaseMerging,2,',','.') .'%' }}
                        </td>
                    @endif
                    <td style="text-align:center;">-</td>
                </tr>
                @endif
            @endforeach

        @endforeach
        @if(!empty($totalPresentase))
            @php
                $dataPresentase = array_sum($totalPresentase) / count($totalComponent);
                $presentase = $dataPresentase > 100 ? '100 %' : number_format($dataPresentase,2,',','.').' %'
            @endphp
        @endif

        <tr>

        </tr>
    </tbody>

</table>
