<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\QueryException;
use App\Http\Controllers\admin\brand\brandController;


class ProductController extends Controller
{

    public function index($parent_id)
    {
        try {
            $Products = Product::where('parent_id', '=', $parent_id)->get(['id', 'name', 'avatar']);
            if ($Products->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Không có biến thể nào!',
                ]);
            }
            return response()->json([
                'status' => true,
                'data' => $Products,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
    public function detail($id)
    {
        try {
            $Product = Product::find($id);
            if (is_null($Product)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Sản phẩm không tồn tại!',
                ], 404);
            }
            return response()->json([
                'status' => true,
                'data' => $Product,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function dataForCreate(BrandController $brandController)
    {
        // Gọi phương thức index từ BrandController đã được inject
        $brands = $brandController->index();

        return response()->json([
            'success' => true,
            'message' => "Lấy danh sách thương hiệu thành công!",
            'brands' => $brands,
        ], 200);
    }
    public function create(Request $request)
    {
        try {
            return response()->json([
                'status' => true,
                'message' => 'Thêm danh mục thành công!',
            ], 201);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function store(Request $request, $id) {}
    public function update($id) {}

    public function destroy($id) {}
}
