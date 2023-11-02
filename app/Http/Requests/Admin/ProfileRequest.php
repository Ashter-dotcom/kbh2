<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    private $user_id;

    public function __construct()
    {
        $this->user_id = encrypt_decrypt(request()->user_id,2);
    }
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
            'name' => 'required|max:255|unique:users,name,'.$this->user_id,
            'email' => 'required|max:255|email|unique:users,email,'.$this->user_id,
            'status' => 'required|boolean',
            'password' => ['nullable','confirmed',Password::min(8)]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank',
            'name.max' => 'Name must not be greater than 255 characters.',

            'email.required' => 'Email cannot be blank',
            'email.max' => 'Email name must not be greater than 255 characters.',

            'status.required' => 'Status cannot be blank',
            'status.boolean' => 'Status only 1 or 0'
        ];
    }
}
