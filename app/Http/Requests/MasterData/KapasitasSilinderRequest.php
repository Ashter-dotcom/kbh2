<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class KapasitasSilinderRequest extends FormRequest
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
            'nama_kelompok' => 'required|max:50|unique:master_data_kapasitas_silinder,nama_kelompok,'.$this->id,
            'minimal' => 'required|integer',
            'maksimal' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'nama_kelompok.required' => 'Nama Kelompok tidak boleh kosong',
            'nama_kelompok.max' => 'Nama Kelompok name tidak boleh lebih dari :max karakter',
            'nama_kelompok.unique' => 'Nama Kelompok tidak boleh sama',

            'minimal.required' => 'Minimal tidak boleh kosong',
            'minimal.integer' => 'Minimal harus berupa angka',

            'maksimal.required' => 'Maksimal tidak boleh kosong',
            'maksimal.integer' => 'Maksimal harus berupa angka'
        ];
    }
}
