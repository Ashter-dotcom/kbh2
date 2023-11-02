<label for="apm">Pilih Perusahaan APM :</label>
<select name="apm" id="apm" class="form-control apm">
    @if(!empty($data['detail_apm']))
        <option value="{{ $data['detail_apm']->id }}" selected>{{ $data['detail_apm']->nama_perusahaan_apm }}</option>
    @else
        <option value="">-- Pilih Perusahaan APM --</option>
    @endif
</select>