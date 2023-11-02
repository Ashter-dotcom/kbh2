<?php

namespace App\Http\Requests\ProductionForm;

use Illuminate\Foundation\Http\FormRequest;

class SellingRequest extends FormRequest
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
        $validation = [
            'tanggal_produksi' => 'required',
            // 'tanggal_penjualan' => 'nullable',
        ];

        $validation['nik'] = 'required|between:17,17|unique:production_selling';

        if(!empty($this->selling_id)) {
            $validation['nik'] = 'required|between:17,17|unique:production_selling,id,'.$this->selling_id;
        }

        if(!empty($this->tanggal_penjualan)) {
            $validation['penjualan'] = 'required';
            $validation['harga'] = 'required';
            $validation['konsumen'] = 'required';
        }

        

        return $validation;
    }


    public function messages()
    {
        return [
            'nik.required' => 'NIK wajib diisi',
            'nik.between' => 'NIK wajib 17 karakter',
            'nik.unique' => 'NIK sudah digunakan',

            'tanggal_produksi.required' => 'Tanggal produksi wajin diisi',

            'penjualan.required' => 'Penjualan wajib diisi',
            'harga.required' => 'Harga Satuan wajib diisi',
            'konsumen.required' => 'Konsumen wajib diisi'
        
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if(!empty($this->tanggal_produksi) && !empty($this->tanggal_penjualan)) {
                if(date('Y-m-d', strtotime($this->tanggal_penjualan)) < date('Y-m-d', strtotime($this->tanggal_produksi))) {
                    return $validator->errors()->add('tanggal_penjualan','Tanggal penjualan tidak boleh lebih kecil dari tanggal produksi');
                }
            }
        });
    }
}
