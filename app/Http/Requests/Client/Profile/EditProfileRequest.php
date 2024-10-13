<?php

namespace App\Http\Requests\Client\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EditProfileRequest extends FormRequest
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
            'name' => [
                'required', // Bắt buộc phải có
                'string',   // Phải là chuỗi ký tự
                'max:255'   // Giới hạn độ dài tối đa là 255 ký tự
            ],
            'phoneNumber' => [
                'required',            // Bắt buộc phải có
                'string',              // Phải là chuỗi ký tự
                'regex:/^[0-9]{10}$/', // Kiểm tra định dạng số điện thoại (10 chữ số)
            ],
        ];
    }

    /**
     * Custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'phoneNumber.required' => 'Số điện thoại là bắt buộc.',
            'phoneNumber.regex' => 'Số điện thoại phải là 10 chữ số.',
            'phoneNumber.unique' => 'Số điện thoại này đã tồn tại.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 409));
    }
}
