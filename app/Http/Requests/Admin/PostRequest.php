<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use illuminate\Http\Request;
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
            'category_id'=>'required',
            'tag'=>'required',
            'content'=>'required',
            'author'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'tiêu đề không được để trống',
            'id_admin_account.required'=>'id admin không được để trống',
            'category_id.required'=>'id chuyên mục bài viết không được để trống',
            'tag.required'=>'tag  không được để trống',
            'content.required'=>'content không được để trống',
            'author.required'=>'author không được để trống',
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
