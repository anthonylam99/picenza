<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name'      => 'required',
            'phone'     => 'required',
            'email'     => 'required|email',
            'feedback'  => 'required',
            'career'    => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Vui lòng nhập họ tên',
            'phone.required'    => 'Vui lòng nhập số điện thoại.',
            'email.required'    => 'Vui lòng nhập Email.',
            'feedback.required' => 'Vui lòng nhập nội dung cần liên hệ',
            'career.required'   => 'Vui lòng nhập ngành nghề lĩnh vực',
            'email.email'       => 'Định dạng email không hợp lệ',
        ];
    }
}
