<p>FORM VERIFIKASI  PENERAPAN JAM KERJA </p>
<p>APM : {{ \Str::upper($data['apm']['nama_perusahaan_apm']) }}</p>
<p>Supplier : {{ \Str::upper($data['supplier']['nama_perusahaan_supplier']) }}</p>
<p>
    Model : {{ !empty($data['model']->nama_model) ? $data['model']->nama_model : ''  }} {{ !empty($data['model']->nama_tipe) ? $data['model']->nama_tipe : '' }} {{ !empty($data['model']->nama_kapasitas_silinder) ? $data['model']->nama_kapasitas_silinder : '' }}
</p>
<table>
                        <tr>
                            <td>User ID</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td>Tanggal Verifikasi</td>
                            <td>: </td>
                        </tr>
                            <td>Surveyor</td>
                            <td>: </td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="7" style="background-color:#56565c; text-align:center; vertical-align: middle;">Waktu Kerja (produksi)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th rowspan="3" style="text-align:center; vertical-align: middle;">Jam Kerja (produksi) per Hari</th>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">a. Shift 1</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">b. Shift 2</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">c. Shift 3</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th rowspan="3" style="text-align:center; vertical-align: middle;">Jam Istirahat per Hari</th>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">a. Shift 1</th>
                                <td>:</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">b. Shift 2</th>
                                <td>:</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">c. Shift 3</th>
                                <td>:</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th rowspan="3" style="text-align:center; vertical-align: middle;">Efektif Jam Kerja (produksi) per Hari</th>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">a. Shift 1</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">b. Shift 2</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th colspan="1" style="text-align:center; vertical-align: middle;">c. Shift 3</th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                            <tr>
                                <th rowspan="1" style="text-align:center; vertical-align: middle;">Hari Kerja per Minggu</th>
                                <th colspan="1" style="text-align:center; vertical-align: middle;"></th>
                                <td>:</td>
                                <th colspan="4" style="text-align:center; vertical-align: middle;"></th>
                            </tr>
                        </tbody>
</table>
