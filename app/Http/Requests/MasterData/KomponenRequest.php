<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class KomponenRequest extends FormRequest
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
            'kategori_id' => 'required',
            'nama_komponen' => 'required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'kategori_id.required' => 'Nama Kategori tidak boleh kosong',

            'nama_komponen.required' => 'Nama Komponen tidak boleh kosong',
            'nama_komponen.max' => 'Nama Komponen tidak boleh lebih dari :max karakter'
        ];
    }
}
