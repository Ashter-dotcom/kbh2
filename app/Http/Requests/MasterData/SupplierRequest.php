<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'nama_perusahaan_supplier' => 'required|max:255|unique:master_data_supplier,nama_perusahaan_supplier,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'nama_perusahaan_supplier.required' => 'Nama Perusahaan tidak boleh kosong',
            'nama_perusahaan_supplier.max' => 'Nama Perusahaan tidak boleh lebih dari :max karakter',
            'nama_perusahaan_supplier.unique' => 'Nama Perusahaan tidak boleh sama'
        ];
    }
}
