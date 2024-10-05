<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PostRequest extends FormRequest
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
            'title'=>'required',
            'id_admin_account'=>'required',
            'categories_id'=>'required',
            'tag'=>'required|string',
            'content'=>'required',
            'author'=>'required',
            'image'=>'required|max:2048',

        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'tiêu đề không được để trống',
            'id_admin_account.required'=>'id admin không được để trống',
            'id_admin_account.exists'=>'id admin không tồn tại',
            'categories_id.required'=>'id chuyên mục bài viết không được để trống',
            'categories_id.exists'=>'id chuyên mục bài viết không tồn tại',
            'tag.required'=>'tag không được để trống',
            'content.required'=>'content không được để trống',
            'author.required'=>'author không được để trống',
            'image.required'=>'image không được để trống',
            'image.max'=>'image không được lớn hơn 2048kb',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors()
        ], 422));
    }
}
