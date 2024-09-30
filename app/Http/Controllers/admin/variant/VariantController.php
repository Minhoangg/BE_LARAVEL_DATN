<?php

namespace App\Http\Controllers\admin\variant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variant;
use Illuminate\Database\QueryException;


class VariantController extends Controller
{

    public function index()
    {
        try {
            $variants = Variant::get(['id', 'name']);
            if (empty($variants)) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'Không có thuộc tính nào trong csdl!',
                ], 200);
            }
            return response()->json([
                'status' => true,
                'message' => 'Lấy danh sách thuộc tính thành công thuộc tính thành công!',
                'data' => $variants,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 404);
        }
    }
}
