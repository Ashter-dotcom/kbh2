<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-baqh{text-align:center;vertical-align:top}
.tg .tg-wa1i{font-weight:bold;text-align:center;vertical-align:middle;background-color:#56565c;color: white;}
.tg .tg-uzvj{border-color:inherit;font-weight:bold;text-align:center;vertical-align:middle}
.tg .tg-0lax{text-align:left;vertical-align:top}
</style>
<p class="h2 text-center font-weight-bold">DATA KAPASITAS PRODUKSI TERPASANG</p><br />
<p class="h2 text-center font-weight-bold">{{ $apm->nama_perusahaan_apm }}</p>
<table class="tg table table-bordered table-striped shadow dataTable no-footer">
<thead>
<tr>
    <th class="tg-uzvj" rowspan="2">No</th>
    <th class="tg-uzvj" colspan="3">Rencana Produksi</th>
    <th class="tg-wa1i" Colspan="2">Kapasitas IUI</th>
    <th class="tg-wa1i" rowspan="2">Keterangan</th>
  </tr>
  <tr>
    <th class="tg-wa1i">Line Produksi Yang Digunakan</th>
    <th class="tg-wa1i">Quantity</th>
    <th class="tg-wa1i">Satuan</th>
    <th class="tg-wa1i">Total</th>
    <th class="tg-wa1i">Satuan</th>
  </tr>
</thead>
<tbody>
  @foreach($supplierComponent as $key => $value)
    <tr>
      <td class="tg-baqh">{{ $key + 1}}</td>
      <td class="tg-0lax">{{ $value['nama_perusahaan'] }}</td>
      <td class="tg-0lax">{{ $value['alamat_perusahaan'] }}</td>
      <td class="tg-0lax">{{ $value['nama_pic'] }}</td>
      <td class="tg-0lax">{{ $value['divisi_pic'] }}</td>
      <td class="tg-0lax">{{ $value['no_telp_pic'] }}</td>
      <td class="tg-0lax">{{ $value['email_pic'] }}</td>
      <td class="tg-0lax">{{ implode(', ', $value['komponen']) }}</td>
      <td class="tg-baqh">{{ $value['tanggal_sedia_verifikasi'] }}</td>
      <td class="tg-0lax">{{ $value['keterangan'] }}</td>
    </tr>
  @endforeach
</tbody>
</table>
