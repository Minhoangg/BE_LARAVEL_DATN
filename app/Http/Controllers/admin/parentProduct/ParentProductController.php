<?php

namespace App\Http\Controllers\admin\parentProduct;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Variant;
use App\Models\Brand;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\admin\variant\VariantController;

class ParentProductController extends Controller
{
    protected $variantController;

    public function __construct(VariantController $variantController)
    {
        $this->variantController = $variantController;
    }
    public function index()
    {
        try {
            $VariantProducts = ParentProduct::where('is_variant_product', true)->get(['id', 'name', 'avatar']);
            $simpleProducts = ParentProduct::where('is_variant_product', false)->get(['id', 'name', 'avatar']);

            if ($VariantProducts->isEmpty() && $simpleProducts->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Chưa có sản phẩm nào trên cơ sở dữ liệu!',
                ], 404);
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
            // Tìm sản phẩm cha theo ID
            $parentProduct = ParentProduct::find($id);

            // Kiểm tra nếu sản phẩm cha không tồn tại
            if (is_null($parentProduct)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Sản phẩm không tồn tại!',
                ], 404);
            }

            // Lấy danh sách sản phẩm con từ quan hệ
            $products = $parentProduct->products;
            if ($products->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Không có biến thể nào!',
                ], 404);
            }
            // Trả về JSON với dữ liệu sản phẩm con
            return response()->json([
                'status' => true,
                'data' => $products,
            ], 200);
        } catch (QueryException $exception) {
            // Xử lý lỗi truy vấn
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function createSimpleProduct(Request $request)
    {
        try {
            // Sử dụng transaction để đảm bảo tất cả các thao tác đều thành công hoặc rollback
            DB::beginTransaction();

            // Thêm thông tin cho parent product
            $parentProduct = new ParentProduct;
            $parentProduct->name = $request->name;
            $parentProduct->id_brand = $request->id_brand;
            $parentProduct->desc = $request->desc;
            $parentProduct->short_desc = $request->short_desc;
            $parentProduct->avatar = $request->avatar;
            $parentProduct->rating = 0;
            $parentProduct->is_variant_product = false;
            $parentProduct->save();  // Lưu trước để lấy id

            // Thêm thông tin cho product
            $product = new Product;
            $product->parent_id = $parentProduct->id;  // Liên kết với parent_product
            $product->name = $request->name;
            $product->price = $request->price;
            $product->avatar = $request->avatar;
            $product->price_sale = $request->price_sale;
            $product->quantity = $request->quantity;
            $product->save();  // Lưu trước để lấy id

            // Thêm danh sách ảnh cho product
            foreach ($request->product_images as $img) {
                $productImage = new ProductImage;
                $productImage->product_id = $product->id;  // Liên kết với product
                $productImage->image_url = $img['image_url'];  // Đường dẫn ảnh
                $productImage->alt_text = $img['alt_text'];  // Alt text (chú thích ảnh)
                $productImage->save();
            }

            // Thêm các biến thể cho sản phẩm
            foreach ($request->variant_attributes as $variant_attribute) {
                $productVariants = new ProductVariant;
                $productVariants->id_variant_attribute = $variant_attribute['id_variant_attribute'];
                $productVariants->id_product = $product->id;
                $productVariants->save();
            }

            // Commit transaction khi mọi thứ đều thành công
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Thêm sản phẩm thành công!',
            ], 201);
        } catch (QueryException $exception) {
            // Rollback transaction khi có lỗi xảy ra
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
                'message' => $exception->getMessage(),  // Log chi tiết lỗi
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
            $parentProduct->is_variant_product = true;


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
    public function dataForCreate()
    {
        // Gọi phương thức index từ BrandController đã được inject
        try {
            $brands = Brand::with('productCategory:id,name')->get(['id', 'name']);
            $variants = $this->variantController->formatVariantData();

            return response()->json([
                'success' => true,
                'message' => "Lấy dữ liệu thêm sản phẩm thành công!",
                'data' => [
                    'brands' => $brands,
                    'variants' => $variants,
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
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
