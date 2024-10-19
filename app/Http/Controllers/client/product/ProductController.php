<?php

namespace App\Http\Controllers\client\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentProduct;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function show()
    {
        $parentProducts = ParentProduct::get();
        $simpleProducts = [];
        $variantProducts = [];
        foreach ($parentProducts as $parentProduct) {
            $cheapestProduct = $parentProduct->products->sortBy('price_sale')->first();
            if ($parentProduct->is_variant_product) {
                $parentProduct['price'] = $cheapestProduct->price;
                $parentProduct['price_sale'] = $cheapestProduct->price_sale;
                unset($parentProduct->products);
                $variantProducts[] = $parentProduct;
            } else {
                $parentProduct['price'] = $cheapestProduct->price;
                $parentProduct['price_sale'] = $cheapestProduct->price_sale;
                unset($parentProduct->products);
                $simpleProducts[] = $parentProduct;
            }
        }
        return [
            'simple_products' => $simpleProducts,
            'variant_products' => $variantProducts,
        ];
    }

    public function showAllChill($parent_id)
    {
        $parentProducts = ParentProduct::find($parent_id);
        $productChills = $parentProducts->products;
        dd($productChills);
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
            $formatVariant = [];
            foreach ($variants as $v) {
                $variantAttributes[] = $v->variantAttribute;
                $formatVariant[] = $v->variantAttribute->variant;
            }
            $product_images = [];
            $product_img = ProductImage::where('product_id', '=', $id)->get();
            foreach ($product_img as $proImg) {
                $product_images[] = [
                    'id' => $proImg->id,
                    'product_id' => $proImg->product_id,
                    'image_url' => $proImg->image_url,
                    'alt_text' => $proImg->alt_text,
                ];
            }
            $Product->desc = $parentProduct->desc;
            $Product->short_desc = $parentProduct->short_desc;
            $Product->rating = $parentProduct->rating;
            return response()->json([
                'status' => true,
                'data' => [
                    'variants_attributes' => $variantAttributes,
                    'product' => $Product,
                    'product_images' => $product_images,
                ],
            ], 200);
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi không xác định!",
            ], 500);
        }
    }

    public function typeProduct($id) {}
}
