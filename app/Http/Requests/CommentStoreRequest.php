<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
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
            'body'          => 'required|min:20',
            'full_name'     => 'required',
            'phone_number'  => 'required',
            'email'         => 'required|email',
            'address'       => 'nullable',
            'gender'        => 'numeric',
            'file'          => 'nullable',
            'product_id'    => 'required',
            'rating'        => 'required',
            'count_worth'   => 'required',
            'count_quality' => 'required',
            'title'         => 'required',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required'    => 'Vui lòng nhập họ tên',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'email.required'        => 'Vui lòng nhập Email.',
            'body.required'         => 'Vui lòng nhập nội dung đánh giá về sản phẩm.',
            'body.min'              => 'Nội dung đánh giá quá ít. Vui lòng nhập thêm nội dung đánh giá về sản phẩm.',
        ];
    }
}
