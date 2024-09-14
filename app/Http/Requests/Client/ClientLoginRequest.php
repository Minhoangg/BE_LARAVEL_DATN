<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ClientLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone_number' => [
                'required',
                'numeric',
                'digits:10',
                'regex:/^0[3-9][0-9]{8}$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'phone_number.numeric' => 'Số điện thoại chỉ có thể chứa các chữ số.',
            'phone_number.regex' => 'Nhập đúng định dạng số điện thoại',
            'phone_number.digits' => 'Số điện thoại phải có 10 chữ số.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 409));
    }
}
