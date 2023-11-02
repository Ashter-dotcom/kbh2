<?php

namespace App\Http\Requests\MasterData;

use Illuminate\Foundation\Http\FormRequest;

class MerekRequest extends FormRequest
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
            'merek' => 'required|max:250',
        ];
    }

    public function messages()
    {
        return [
            'apm_id.required' => 'Nama Perusahaan APM tidak boleh kosong',
            'merek.required' => 'Nama merek tidak boleh kosong'
        ];
    }
}
