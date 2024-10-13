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
            if ($variants->isEmpty()) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'Không có thuộc tính nào trong csdl!',
                ], 404);
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
            ], 500);
        }
    }

    public function formatVariantData()
    {
        $variants = Variant::with(['variantAttributes:id,name,id_variant'])->get(['id', 'name']);
        return $variants;
    }

    public function create(Request $request)
    {
        try {
            $variant = new Variant;
            $variant->name = $request->name;
            $variant->save();
            return response()->json([
                'status' => true,
                'message' => 'Thêm thuộc tính thành công!',
                'data' => $variant,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function store(Request $request, $id)
    {
        try {
            $variant = Variant::find($id);
            if (is_null($variant)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Thuộc tính không tồn tại!',
                ], 404);
            }
            $variant->name = $request->name;
            $variant->save();
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thuộc tính thành công!',
                'data' => $variant,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
    public function update($id)
    {
        try {
            $variant = Variant::find($id);
            if (is_null($variant)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Thuộc tính không tồn tại!',
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Lấy thành công thuộc tính cần cập nhật!',
                'data' => $variant,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định không!",
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $variant = Variant::find($id);
            if (is_null($variant)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Thuộc tính không tồn tại!',
                ], 404);
            }
            $variant->delete();
            return response()->json([
                'status' => true,
                'message' => 'Xóa thành công thuộc tính!',
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
}
