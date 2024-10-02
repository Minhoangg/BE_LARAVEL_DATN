<?php

namespace App\Http\Controllers\admin\variantAttribute;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VariantAttribute;
use Illuminate\Database\QueryException;


class VariantAttributeController extends Controller
{

    public function index($id_variant)
    {
        try {
            $variantAttributes = VariantAttribute::where('id_variant', $id_variant)
                ->select('name', 'color_code', 'id_variant', 'id')
                ->get();
            // Loại bỏ 'color_code' nếu nó là null
            $variantAttributes->transform(function ($item) {
                if (is_null($item->color_code)) {
                    unset($item->color_code);
                }
                return $item;
            });
            if ($variantAttributes->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => "Chưa có dữ liệu!",
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => "Lấy giá trị thành công!",
                'data' => $variantAttributes,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
    public function destroy($id)
    {
        try {
            $variant = VariantAttribute::find($id);
            if (is_null($variant)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Giá trị thuộc tính không tồn tại!',
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
    public function create(Request $request)
    {
        try {
            $VariantAttribute = new VariantAttribute;
            $VariantAttribute->name = $request->name;
            if (is_null($request->color_code)) {
                $VariantAttribute->color_code = null;
            } else {
                $VariantAttribute->color_code = $request->color_code;
            }
            $VariantAttribute->id_variant = $request->id_variant;
            $VariantAttribute->save();
            return response()->json([
                'status' => true,
                'message' => 'Thêm giá trị thuộc tính thành công!',
                'data' => $VariantAttribute,
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
            $VariantAttribute = VariantAttribute::find($id);
            if (is_null($VariantAttribute)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Giá trị thuộc tính không tồn tại!',
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Lấy thành công giá trị thuộc tính cần cập nhật!',
                'data' => $VariantAttribute,
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
            $variantAttribute = VariantAttribute::find($id);
            if (is_null($variantAttribute)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Giá trị thuộc tính không tồn tại!',
                ], 404);
            }
            $variantAttribute->name = $request->name;
            if (is_null($request->color_code)) {
                $variantAttribute->color_code = null;
            } else {
                $variantAttribute->color_code = $request->color_code;
            }
            $variantAttribute->save();
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật thành công thuộc tính!',
                'data' => $variantAttribute,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'status' => true,
                'message' => 'Lỗi không xác định!',
                'data' => $variantAttribute,
            ], 500);
        }
    }
}
