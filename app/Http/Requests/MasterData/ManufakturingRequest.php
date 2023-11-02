<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class ManufakturingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'apm_id' => 'required',
            'model_id' => 'required',
            'periode_id' => 'required',
            'nama_tipe' => 'required',
            'kondisi' => 'required|max:50',
            'rencana_kemenperin' => 'required|max:50',
            'rencana_apm' => 'required|max:50',
            'realisasi' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'apm_id.required' => 'Nama Perusahaan APM tidak boleh kosong',
            'model_id.required' => 'Nama Model tidak boleh kosong',
            'periode_id.required' => 'Periode tidak boleh kosong',
            'nama_tipe.required' => 'Tipe Transmisi tidak boleh kosong',

            // 'jenis_kbm.required' => 'Jenis KBM tidak boleh kosong',
            // 'jenis_kbm.max' => 'Jenis KBM tidak boleh lebih dari :max karakter',

            // 'nama_model.required' => 'Nama Model tidak boleh kosong',
            // 'nama_model.max' => 'Nama Model tidak boleh lebih dari :max karakter',

            // 'nama_tipe.required' => 'Nama Tipe tidak boleh kosong',
            // 'nama_tipe.max' => 'Nama Tipe tidak boleh lebih dari :max karakter',

            // 'nama_varian.required' => 'Nama Varian tidak boleh kosong',
            // 'nama_varian.max' => 'Nama Varian tidak boleh lebih dari :max karakter',

            // 'nama_kapasitas_silinder.required' => 'Kapasitas Silinder tidak boleh kosong',
            // 'nama_kapasitas_silinder.integer' => 'Kapasitas Silinder harus angka',

            // 'rencana_produksi_2022.required' => 'Rencana Produksi 2022 tidak boleh kosong',
            // 'rencana_produksi_2022.integer' => 'Rencana Produksi 2022 harus angka',

            // 'rencana_produksi_2023.required' => 'Rencana Produksi 2023 tidak boleh kosong',
            // 'rencana_produksi_2023.integer' => 'Rencana Produksi 2023 harus angka'
        ];
    }
}
