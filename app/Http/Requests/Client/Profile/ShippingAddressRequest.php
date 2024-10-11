<?php

namespace App\Http\Requests\Client\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ShippingAddressRequest extends FormRequest
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
            'city' => [
                'required',  // City is mandatory
                'string',    // Must be a string
                'max:255',   // Max length of 255 characters
            ],
            'district' => [
                'required',  // District is mandatory
                'string',    // Must be a string
                'max:255',   // Max length of 255 characters
            ],
            'ward' => [
                'required',  // Ward is mandatory
                'string',    // Must be a string
                'max:255',   // Max length of 255 characters
            ],
            'street_address' => [
                'required',  // Street address is mandatory
                'string',    // Must be a string
                'max:255',   // Max length of 255 characters
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
            'city.required' => 'Thành phố là bắt buộc.',
            'city.string' => 'Thành phố phải là chuỗi ký tự.',
            'city.max' => 'Thành phố không được vượt quá 255 ký tự.',
            'district.required' => 'Quận/huyện là bắt buộc.',
            'district.string' => 'Quận/huyện phải là chuỗi ký tự.',
            'district.max' => 'Quận/huyện không được vượt quá 255 ký tự.',
            'ward.required' => 'Phường/xã là bắt buộc.',
            'ward.string' => 'Phường/xã phải là chuỗi ký tự.',
            'ward.max' => 'Phường/xã không được vượt quá 255 ký tự.',
            'street_address.required' => 'Địa chỉ là bắt buộc.',
            'street_address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'street_address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
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
            'errors' => $validator->errors(),
        ], 409));
    }
}
