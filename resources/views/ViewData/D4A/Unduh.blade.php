<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-wa1i{font-weight:bold;text-align:center;vertical-align:middle;background-color:#56565c;color: white;}
.tg .tg-uzvj{border-color:inherit;font-weight:bold;text-align:center;vertical-align:middle;background-color:#56565c;color: white;}
.tg .tg-0lax{text-align:left;vertical-align:top}
</style>
<p class="h2 text-center font-weight-bold">RENCANA TAHAPAN MANUFAKTUR DAN PENGGUNAAN KOMPONEN LAINNYA</p>
<p class="h2 text-center font-weight-bold">{{ $apm->nama_perusahaan_apm }}</p>
<table class="tg table table-bordered table-striped shadow dataTable no-footer">
<thead>
  <tr>
    <th class="tg-uzvj" rowspan="2">No</th>
    <th class="tg-uzvj" colspan="2">Produk</th>
    <th class="tg-wa1i" colspan="3">Panduan Rencana Tahapan Manufaktur Sesuai PerMenPerin</th>
    <th class="tg-uzvj" colspan="2">Rencana Tahapan Manufaktur</th>
    <th class="tg-uzvj" rowspan="2">Nama Perusahaan</th>
    <th class="tg-uzvj" rowspan="2">Local / import</th>
    <th class="tg-uzvj" rowspan="2">Kondisi</th>
    <th class="tg-uzvj" rowspan="2">Keterangan</th>
  </tr>
  <tr>
    <th class="tg-wa1i">Kelompok Barang</th>
    <th class="tg-wa1i">Nama Komponen Aktual</th>
    <th class="tg-wa1i">Nama Komponen</th>
    <th class="tg-wa1i">Tahun</th>
    <th class="tg-wa1i">Kondisi</th>
    <th class="tg-wa1i">Tahun</th>
    <th class="tg-wa1i">Kondisi</th>
  </tr>
</thead>
<tbody>
  @foreach($attribute as $key => $value)
    <tr>
      <td class="tg-baqh">{{ $key + 1}}</td>
      <td class="tg-0lax">{{ $value['title'] }}</td>
      <td class="tg-baqh">{{ $value['unit'] }}</td>
      <?php $total = 0 ;?>
      @foreach($periodeTahun as $k => $periode)
        <?php $data = array_values(array_filter(json_decode(json_encode($profil), true), function ($val) use ($kondisi, $periode) {
    return ($val['bulan'] == $periode['bulan'] and $val['tahun'] == $periode['tahun'] and $val['kondisi'] == $kondisi);
})); ?>
        @if(isset($data[0][$value['attribute']]))
          <?php $total += $data[0][$value['attribute']];?>
          @if($value['attribute'] === 'tingkat_utilitas')
            <td class="tg-baqh">{{ number_format( (float) $data[0][$value['attribute']], 4, ',', '.') }}</td>
          @else
            <td class="tg-baqh">{{ number_format( (float) $data[0][$value['attribute']], 0, ',', '.') }}</td>
          @endif
        @else

        @endif

      @endforeach
      @if($value['attribute'] === 'jumlah_tenaga_kerja')
        <td class="tg-baqh">-</td>
      @elseif($value['attribute'] === 'tingkat_utilitas')
        <td class="tg-baqh">{{ number_format( (float)($total / count($periodeTahun)), 2, '.', '') }}</td>
      @else
        <td class="tg-baqh">{{ number_format( (float) $total, 0, ',', '.') }}</td>
      @endif
    </tr>
  @endforeach
</tbody>
</table>
<br />
<div class="row">
    <div class="col-md-10 col-xs-12 col-sm-12 col-lg-10">
    </div>
    <div class="col-md-2 col-xs-12 col-sm-12 col-lg-2" style="text-align:center;">
</div>
