<?php

namespace App\Http\Controllers\admin\parentProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentProduct;
use App\Models\Product;
use Illuminate\Database\QueryException;
use App\Http\Controllers\admin\brand\brandController;



class ParentProductController extends Controller
{

    public function index()
    {
        try {
            $parentProducts = ParentProduct::get(['id', 'name', 'avatar']);
            if ($parentProducts->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Chưa có sản phẩm nào trên cơ sở dữ liệu!',
                ], 404);
            }
            $simpleProducts = [];
            $VariantProducts = [];
            foreach ($parentProducts as $product) {
                if ($this->checkIsSimpleProduct($product->id)) {
                    $VariantProducts[] = $product;
                } else {
                    $simpleProducts[] = $product;
                }
            }
            return response()->json([
                'status' => true,
                'data' => [
                    'simpleProducts' => $simpleProducts,
                    'variantProducts' => $VariantProducts,
                ],
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
            $parentProduct = ParentProduct::find($id);
            if (is_null($parentProduct)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Sản phẩm không tồn tại!',
                ], 404);
            }
            return response()->json([
                'status' => true,
                'data' => $parentProduct,
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
    public function createSimpleProduct(Request $request)
    {
        try {
            $parentProduct = new ParentProduct;
            $parentProduct->name = $request->name;
            $parentProduct->id_brand = $request->id_brand;
            $parentProduct->desc = $request->desc;
            $parentProduct->short_desc = $request->short_desc;
            $parentProduct->avatar = $request->avatar;
            $parentProduct->rating = 0;
            $parentProduct->price = $request->price;
            $parentProduct->price_sale = $request->price_sale;
            $parentProduct->quantity = $request->quantity;

            $parentProduct->save();
            return response()->json([
                'status' => true,
                'message' => 'Thêm sản phẩm thành công!',
            ], 201);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function createProductVariant(Request $request)
    {
        try {
            $parentProduct = new ParentProduct;
            $parentProduct->name = $request->name;
            $parentProduct->id_brand = $request->id_brand;
            $parentProduct->desc = $request->desc;
            $parentProduct->short_desc = $request->short_desc;
            $parentProduct->avatar = $request->avatar;
            $parentProduct->rating = 0;

            $parentProduct->save();
            return response()->json([
                'status' => true,
                'message' => 'Thêm sản phẩm thành công!',
            ], 201);
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
    public function checkIsSimpleProduct($parent_id)
    {
        $product = Product::where('parent_id', '=', $parent_id)->get();
        if (count($product) > 0) {
            return true;
        }
        return false;
    }
    public function store(Request $request, $id)
    {
        try {
            $parentProduct = ParentProduct::find($id);
            if (is_null($parentProduct)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Sản phẩm không tồn tại!',
                ], 404);
            }
            $parentProduct->name = $request->name;
            $parentProduct->id_brand = $request->id_brand;
            $parentProduct->desc = $request->desc;
            $parentProduct->short_desc = $request->short_desc;
            $parentProduct->avatar = $request->avatar;
            $parentProduct->rating = 0;
            if ($this->checkIsSimpleProduct($parentProduct->id)) {
                $parentProduct->price = $request->price;
                $parentProduct->price_sale = $request->price_sale;
                $parentProduct->quantity = $request->quantity;
            }
            $parentProduct->save();
            return response()->json([
                'success' => true,
                'message' => "Cập nhật sản phẩm thành công!",
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
    public function update($id)
    {
        try {
            $parentProduct = ParentProduct::find($id);
            if (is_null($parentProduct)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Sản phẩm không tồn tại!',
                ], 404);
            }
            return response()->json([
                'success' => true,
                'message' => 'Lấy thông tin sản phẩm cần cập nhật thành công!',
                'data' => $parentProduct,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $parentProduct = ParentProduct::find($id);
            if (is_null($parentProduct)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Sản phẩm không tồn tại!',
                ], 404);
            }
            $parentProduct->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa sản phẩm thành công!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }
}
