<?php

namespace App\Http\Controllers\admin\productCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Database\QueryException;


class productCategoryController extends Controller
{

    // public function index()
    // {
    //     // Lấy tất cả danh mục cha (parent_id là null)
    //     $categories = ProductCategory::whereNull('parent_id')->get();

    //     // Đệ quy để lấy danh mục con
    //     $categories = $categories->map(function ($category) {
    //         return $this->formatCategory($category);
    //     });

    //     return response()->json($categories);
    // }

    // // Hàm format danh mục và đệ quy lấy danh mục con
    // private function formatCategory($category)
    // {
    //     // Lấy tất cả brands có id_product_categories trùng với $category->id
    //     $brands = Brand::where('id_product_categories', $category->id)->get();

    //     return [
    //         'id' => $category->id,
    //         'name' => $category->name,
    //         'parent_id' => $category->parent_id,
    //         'img_icon' => $category->img_icon,
    //         'brands' => $brands->map(function ($brand) {
    //             return [
    //                 'id' => $brand->id,
    //                 'name' => $brand->name,
    //                 'img' => $brand->img,
    //                 'desc' => $brand->desc,
    //             ];
    //         }),
    //     ];
    // }

    public function index()
    {
        try {
            $categories = ProductCategory::get(['id', 'name', 'img_icon']);
            if ($categories->isEmpty()) {
                return response()->json([
                    'status' => 'true',
                    'message' => 'Không có danh mục nào trong csdl!',
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Lấy danh sách danh mục thành công thành công!',
                'data' => $categories,
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
            $category = new ProductCategory;
            $category->name = $request->name;
            $category->img_icon = $request->img_icon;
            $category->save();
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

    public function store(Request $request, $id)
    {
        try {
            $category = ProductCategory::find($id);
            if (is_null($category)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Danh mục không tồn tại!',
                ], 404);
            }
            $category->name = $request->name;
            $category->img_icon = $request->img_icon;
            $category->save();
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật danh mục thành công!',
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
            $category = ProductCategory::find($id);
            if (is_null($category)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Danh mục không tồn tại!',
                ], 404);
            }
            return response()->json([
                'status' => true,
                'message' => 'Lấy thành công danh mục cần cập nhật!',
                'data' => $category,
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
            $category = ProductCategory::find($id);
            if (is_null($category)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Danh mục không tồn tại!',
                ], 404);
            }
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Xóa danh mục thành công!',
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
}
