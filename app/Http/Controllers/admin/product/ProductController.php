<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\models\ParentProduct;
use App\Models\Variant;
use App\Models\Brand;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\admin\variant\VariantController;

class ProductController extends Controller
{
    protected $variant;
    public function __construct(VariantController $variant)
    {
        $this->variant = $variant;
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
            $parentProduct = ParentProduct::find($Product->parent_id);
            $variants = ProductVariant::where('id_product', '=', $id)->get();
            $variantAttributes = [];
            foreach ($variants as $variant) {
                $variantAttributes[] = $variant->variantAttribute;
            }
            $Product['desc'] = $parentProduct->desc;
            $product['short_desc'] = $parentProduct->short_desc;
            $product['rating'] = $parentProduct->rating;
            return response()->json([
                'status' => true,
                'data' => [
                    'variants_attributes' => $variantAttributes,
                    'product' => $Product,
                ],
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function dataForCreate($parent_id)
    {
        $data = $this->variant->formatVariantData();
        return response()->json([
            'success' => true,
            'message' => "Lấy danh sách thương hiệu thành công!",
            'brands' => $data,
        ], 200);
    }

    public function create(Request $request)
    {
        try {
            // Sử dụng transaction để đảm bảo tất cả các thao tác đều thành công hoặc rollback
            DB::beginTransaction();
            $product = new Product;
            $product->parent_id = $request->parent_id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->avatar = $request->avatar;
            $product->price_sale = $request->price_sale;
            $product->quantity = $request->quantity;
            $product->save();

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

    public function updateSimple(Request $request, $id) {}
    public function updateVariant(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($id);
            if (is_null($product)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Sản phẩm không tồn tại!',
                ], 404);
            }
            $product->name = $request->name;
            $product->price = $request->price;
            $product->price_sale = $request->price_sale;
            $product->quantity = $request->quantity;
            $product->save();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
                'message' => $exception->getMessage(),
            ], 500);
        }
    }
    public function getVariantAttribute() {}

    public function getInfoUpdate($id) {}

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (is_null($product)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Sản phẩm không tồn tại!',
                ], 404);
            }
            $product->delete();
            return response()->json([
                'status' => true,
                'message' => 'Xóa sản phẩm thành công!',
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lôi không xác định!",
            ], 500);
        }
    }
}
