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
<p class="h2 text-center font-weight-bold">FORM DAFTAR KOMPONEN INHOUSE PERUSAHAAN PEMOHON FASILITAS LCEV</p><br />
<table>
  <thead>
    <tr>
      <th>Perusahaan Pemohon</th>
      <th>: {{ $apm->nama_perusahaan_apm }}</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Alamat</td>
      <td>: {{ $apm->alamat_kantor }}</td>
    </tr>
    <tr>
      <td>Nama PIC</td>
      <td>: {{ $apm->nama_pic }}</td>
    </tr>
    <tr>
      <td>Telp./HP</td>
      <td>: {{ $apm->no_telp_kantor }}</td>
    </tr>
  </tbody>
</table>
<a href="{{ route('view-data-d1c-unduh', [ 'apm' => $apm->id ]) }}"><button class="btn btn-dark btn-sm float-right btn-unduh shadow"><i class="fa fa-save"></i> Unduh</button></a><br /><br />
<table class="tg table table-bordered table-striped shadow dataTable no-footer">
<thead>
  <tr>
    <th class="tg-wa1i">No</th>
    <th class="tg-wa1i">Nama Perusahaan</th>
    <th class="tg-wa1i">Alamat</th>
    <th class="tg-wa1i">PIC</th>
    <th class="tg-wa1i">Divisi</th>
    <th class="tg-wa1i">No. Telp</th>
    <th class="tg-wa1i">Alamat Email</th>
    <th class="tg-wa1i">Produk</th>
    <th class="tg-wa1i">Jenis Proses Part</th>
    <th class="tg-wa1i">Tanggal Kesediaan Diverifikasi</th>
    <th class="tg-wa1i">Keterangan</th>
  </tr>
</thead>
<tbody>
  @foreach($supplierComponent as $key => $value)
    <tr>
      <td class="tg-baqh">{{ $key + 1}}</td>
      <td class="tg-0lax">{{ $apm->nama_perusahaan_apm }}</td>
      <td class="tg-0lax">{{ $apm->alamat_kantor }}</td>
      <td class="tg-0lax">{{ $apm->nama_pic }}</td>
      <td class="tg-0lax">{{ $apm->divisi_pic }}</td>
      <td class="tg-0lax">{{ $apm->no_telp_pic }}</td>
      <td class="tg-0lax">{{ $apm->email_pic }}</td>
      <td class="tg-0lax">{{ implode(', ', $value['komponen']) }}</td>
      <td class="tg-0lax">{{ $value['nama_model'] }}</td>
      <td class="tg-baqh">{{ $apm->tanggal_kesediaan_diverifikasi }}</td>
      <td class="tg-0lax"></td>
    </tr>
  @endforeach
</tbody>
</table>
