<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class InvestasiApmRequest extends FormRequest
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
            'slug' => 'required|max:50|unique:master_data_apm,slug,'.$this->id,
            'nama_perusahaan_apm' => 'required|max:255|unique:master_data_apm,nama_perusahaan_apm,'.$this->id,
            'nama_pic' => 'required|max:50',
            'npwp_perusahaan' => 'required|max:20',
            'no_telp_kantor' => 'max:15',
            'divisi_pic' => 'required',
            'email_pic' => 'required',
            'no_telp_pic' => 'required'
            'nama_periode' => 'required|max:50|unique:master_data_periode,nama_periode,'.$this->id,
        ];
    }

    // {
    //     return [
    //         'nama_periode' => 'required|max:50|unique:master_data_periode,nama_periode,'.$this->id,
    //         'mulai' => 'required|date',
    //         'selesai' => 'required|date',
    //         'kelompok_kapasitas_silinder' => 'required'
    //     ];
    // }

    public function messages()
    {
        return [
            'slug.required' => 'Slug tidak boleh kosong',
            'slug.max' => 'Slug name tidak boleh lebih dari :max karakter',
            'slug.unique' => 'Slug tidak boleh sama',

            'nama_perusahaan_apm.required' => 'Nama perusahaan tidak boleh kosong',
            'nama_perusahaan_apm.max' => 'Nama perusahaan tidak boleh lebih dari :max karakter',
            'nama_perusahaan_apm.unique' => 'Nama perusahaan tidak boleh sama',

            'nama_pic.required' => 'Nama PIC tidak boleh kosong',
            'nama_pic.max' => 'Nama PIC tidak boleh lebih dari :max karakter',

            'npwp_perusahaan.required' => 'NPWP Perusahaan tidak boleh kosong',
            'npwp_perusahaan.max' => 'NPWP Perusahaan tidak boleh lebih dari :max karakter',

            'no_telp_kantor.max' => 'No Telp kantor tidak boleh lebih dari :max karakter',

            'divisi_pic.required' => 'Divisi PIC tidak boleh kosong',
            'email_pic.required' => 'Email PIC tidak boleh kosong',
            'no_telp_pic.required' => 'No Telp PIC tidak boleh kosong'
        ];
    }
}
