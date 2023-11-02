<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{


    private $role_id;
    public $permission;

    public function __construct()
    {
        $this->role_id = encrypt_decrypt(request()->role_id,2);
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
            'name' => 'required|max:255|unique:roles,name,'.$this->role_id,
            'permission' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Role name cannot be blank',
            'name.max' => 'Role name must not be greater than 255 characters.',

            'permission.required' => 'Permission cannot be blank'
        ];
    }
}
