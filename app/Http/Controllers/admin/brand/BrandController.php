<?php

namespace App\Http\Controllers\admin\brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Brand;
use App\Models\ProductCategory;
use Illuminate\Database\QueryException;


class BrandController extends Controller
{

    public function index()
    {
        try {
            $brands = Brand::get(['id', 'name', 'desc', 'img', 'id_product_categories']);
            if ($brands->isEmpty()) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'Không có danh mục nào trong csdl!',
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Lấy danh sách danh mục thành công thành công!',
                'data' => $brands,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function getCategories()
    {
        try {
            $category = ProductCategory::get(['id', 'name']);
            return response()->json([
                'success' => true,
                'message' => 'Lấy danh mục sản phẩm thành công!',
                'data' => $category,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->desc = $request->desc;
            $brand->img = $request->img;
            $brand->id_product_categories = $request->id_product_categories;
            $brand->save();
            return response()->json([
                'success' => true,
                'message' => 'Thêm thương hiệu thành công!',
                'data' => $brand,
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
            $brand = Brand::find($id);
            if (is_null($brand)) {
                return response()->json([
                    'success' => false,
                    'error' => "Thương hiệu không tồn tại!",
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => "lấy dữ liệu thương hiệu cần cập nhật thành công!",
                'data' => $brand,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
    public function updateData(Request $request, $id)
    {
        try {
            $brand = Brand::find($id);
            if (is_null($brand)) {
                return response()->json([
                    'success' => false,
                    'error' => "Thương hiệu không tồn tại!",
                ], 404);
            }
            $brand->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Cập nhật thương hiệu thành công!',
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
            $brand = Brand::find($id);
            if (is_null($brand)) {
                return response()->json([
                    'success' => false,
                    'error' => "Thương hiệu không tồn tại!",
                ], 404);
            }
            $brand->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa thương hiệu thành công!',
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
}
