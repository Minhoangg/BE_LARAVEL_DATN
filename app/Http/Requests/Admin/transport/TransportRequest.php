<?php

namespace App\Http\Requests\Admin\transport;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class TransportRequest extends FormRequest
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
            'payment_type_id' => 'required|integer|in:1,2', // 1: Thanh toán khi nhận, 2: Đã thanh toán
            'note' => 'nullable|string|max:255',
            'required_note' => 'required|string|max:255',
            'contents' => 'required|string|max:255',
            'cod_failed_amount' => 'required|integer|min:0', // Số tiền phải là số dương
            'pickup_time' => 'required|integer', // Giả sử bạn đang sử dụng timestamp
            'pick_shift' => 'required|array',
            'pick_shift.*' => 'integer|in:1,2,3', // Giả sử các giá trị hợp lệ là 1, 2, hoặc 3
        ];
    }

    public function messages(): array
    {
        return [
            'payment_type_id.required' => 'Vui lòng chọn phương thức thanh toán.',
            'payment_type_id.integer' => 'Phương thức thanh toán phải là một số nguyên.',
            'payment_type_id.in' => 'Phương thức thanh toán không hợp lệ.',
            'note.string' => 'Ghi chú phải là một chuỗi.',
            'note.max' => 'Ghi chú không được vượt quá 255 ký tự.',
            'required_note.required' => 'Vui lòng nhập ghi chú yêu cầu.',
            'required_note.string' => 'Ghi chú yêu cầu phải là một chuỗi.',
            'required_note.max' => 'Ghi chú yêu cầu không được vượt quá 255 ký tự.',
            'content.required' => 'Nội dung đơn hàng là bắt buộc.',
            'content.string' => 'Nội dung đơn hàng phải là một chuỗi.',
            'content.max' => 'Nội dung đơn hàng không được vượt quá 255 ký tự.',
            'cod_failed_amount.required' => 'Vui lòng nhập số tiền COD thất bại.',
            'cod_failed_amount.integer' => 'Số tiền COD thất bại phải là một số nguyên.',
            'cod_failed_amount.min' => 'Số tiền COD thất bại không được nhỏ hơn 0.',
            'pickup_time.required' => 'Vui lòng nhập thời gian lấy hàng.',
            'pickup_time.integer' => 'Thời gian lấy hàng phải là một số nguyên.',
            'pick_shift.required' => 'Vui lòng chọn ca lấy hàng.',
            'pick_shift.array' => 'Ca lấy hàng phải là một mảng.',
            'pick_shift.*.integer' => 'Giá trị của ca lấy hàng phải là một số nguyên.',
            'pick_shift.*.in' => 'Giá trị của ca lấy hàng không hợp lệ.',
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
