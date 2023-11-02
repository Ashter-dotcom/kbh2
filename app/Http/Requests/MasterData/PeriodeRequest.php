<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class PeriodeRequest extends FormRequest
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
            'nama_periode' => 'required|max:50|unique:master_data_periode,nama_periode,'.$this->id,
            'mulai' => 'required|date',
            'selesai' => 'required|date',
            'kelompok_kapasitas_silinder' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_periode.required' => 'Nama Periode tidak boleh kosong',
            'nama_periode.max' => 'Nama Periode name tidak boleh lebih dari :max karakter',
            'nama_periode.unique' => 'Nama Periode tidak boleh sama',

            'mulai.required' => 'Tanggal Mulai tidak boleh kosong',
            'mulai.date' => 'Tanggal Mulai harus berupa tanggal',

            'selesai.required' => 'Tanggal Selesai tidak boleh kosong',
            'selesai.date' => 'Tanggal Selesai harus berupa tanggal',
            
            'kelompok_kapasitas_silinder.required' => 'Kelompok Kapasitas Silinder tidak boleh kosong'
        ];
    }
}
