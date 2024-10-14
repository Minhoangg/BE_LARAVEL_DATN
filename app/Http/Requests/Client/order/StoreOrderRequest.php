<?php

namespace App\Http\Requests\Client\order;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    // Xác định xem người dùng có quyền thực hiện yêu cầu này hay không
    public function authorize()
    {
        return true; // Thay đổi nếu cần thiết
    }

    // Các quy tắc xác thực
    public function rules()
    {
        return [
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }

    // Tùy chọn: Tùy chỉnh thông báo xác thực
    public function messages()
    {
        return [
            'products.required' => 'Danh sách sản phẩm là bắt buộc.',
            'products.array' => 'Danh sách sản phẩm phải là một mảng.',
            'products.*.product_id.required' => 'Mã sản phẩm là bắt buộc.',
            'products.*.product_id.exists' => 'Sản phẩm không tồn tại.',
            'products.*.quantity.required' => 'Số lượng là bắt buộc.',
            'products.*.quantity.integer' => 'Số lượng phải là một số nguyên.',
            'products.*.quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
        ];
    }
}
