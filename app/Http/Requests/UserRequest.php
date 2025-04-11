<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required|alpha_num|min:4',
            'password' => 'required|min:4|max:30',
            //   'username'=>[
            //     'required',
            //      'alpha_num',
            //      'min:4',
            //       new CustomValidationUsername($this->username)  
            // ],
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng nhập tài khoản',
            'username.alpha_num' => 'Tài khoản không chứa kí tự đặc biệt, chỉ chứa kí tự (a-z A-Z 0-9)',
            'username.min' => 'Tài khoản phải tối thiểu 4 kí tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải tối thiểu 4 kí tự',
            'password.max' => 'Mật khẩu chỉ tối đã 30 kí tự'
        ];
    }
}
