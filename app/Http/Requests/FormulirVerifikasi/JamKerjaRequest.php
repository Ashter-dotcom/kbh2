<?php

namespace App\Http\Requests\FormulirVerifikasi;

use Illuminate\Foundation\Http\FormRequest;

class JamKerjaRequest extends FormRequest
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
            'supplier_id' => 'required',
            'prosesproduksi' => 'required|max:250',
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'Nama Perusahaan APM tidak boleh kosong',
            'prosesproduksi.required' => 'Nama merek tidak boleh kosong'
        ];
    }
}
