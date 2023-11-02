<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{

    private $permission_id;

    public function __construct()
    {
        $this->permission_id = encrypt_decrypt(request()->input('permission_id'),2);
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
            'name' => 'required|max:255|unique:permissions,name,'.$this->permission_id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Permission name cannot be blank',
            'name.max' => 'Permission name must not be greater than 255 characters.'
        ];
    }
}
