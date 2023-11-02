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
<p class="h2 text-center font-weight-bold">PROFIL SUPPLIER SEBELUM MENDAPATKAN INSENTIF LCEV</p>
<p class="h2 text-center font-weight-bold">{{ $supplier->nama_perusahaan_supplier }}</p>
<a href="{{ route('view-data-d5a-unduh', [ 'supplier' => $supplier->id ]) }}"><button class="btn btn-dark btn-sm float-right btn-unduh shadow"><i class="fa fa-save"></i> Unduh</button></a><br /><br />
<table class="tg table table-bordered table-striped shadow dataTable no-footer">
<thead>
  <tr>
    <th class="tg-uzvj" rowspan="2">No</th>
    <th class="tg-uzvj" rowspan="2">Profil</th>
    <th class="tg-wa1i" rowspan="2">Satuan</th>
    <th class="tg-wa1i" colspan="12">12 Bulan Sebelum Mendapatkan Insentif</th>
    <th class="tg-wa1i" rowspan="2">TOTAL</th>
  </tr>
  <tr>
    <th class="tg-wa1i">Jan</th>
    <th class="tg-wa1i">Feb</th>
    <th class="tg-wa1i">Mar</th>
    <th class="tg-wa1i">Apr</th>
    <th class="tg-wa1i">Mei</th>
    <th class="tg-wa1i">Jun</th>
    <th class="tg-wa1i">Jul</th>
    <th class="tg-wa1i">Aug</th>
    <th class="tg-wa1i">Sep</th>
    <th class="tg-wa1i">Okt</th>
    <th class="tg-wa1i">Nov</th>
    <th class="tg-wa1i">Des</th>
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
          <td class="tg-baqh">Belum Diisi</td>
        @endif

      @endforeach
      @if($value['attribute'] === 'jumlah_tenaga_kerja')
        <td class="tg-baqh">-</td>
      @elseif($value['attribute'] === 'tingkat_utilitas')
        <td class="tg-baqh">{{ number_format((float)($total / count($periodeTahun)), 2, '.', '') }}</td>
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
        <p>Jakarta, ___ ___________ _____</p>
        <p>Mengetahui</p>
        <br /><br /><br />
        <p><b>( ........................................ )</b></p>
        <p><b>Pimpinan / Penanggung Jawab</b></p>
    </div>
</div>
