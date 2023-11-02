<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    public $role;
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
        $validation = [
            'name' => 'required|max:255|unique:users,name,'.$this->user_id,
            'email' => 'required|max:255|email|unique:users,email,'.$this->user_id,
            'status' => 'required|boolean',
            'role' => 'required'
        ];

        if(empty($this->user_id)) {
            $validation['password'] = ['required','confirmed',Password::min(8)];
        }
        
        return $validation;
    }

    public function messages()
    {
        return [
            'name.required' => 'Name cannot be blank',
            'name.max' => 'Name must be less or equal than 255',
            'name.unique' => 'Name already used',

            'email.required' => 'Email cannot be blank',
            'email.max' => 'Email must be less or equal than 255',
            'email.unique' => 'Email already used',

            'status.required' => 'Status cannot be blank',
            'status.boolean' => 'Status only 1 or 0',

            'role.*.required' => 'Role cannot be blank',

            'password.required' => 'Password cannot be blank'
        ];
    }
}
