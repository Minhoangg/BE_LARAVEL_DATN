<?php

namespace App\Http\Controllers\client\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentProduct;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function show()
    {
        // Eager load danh mục và chỉ lấy các cột cần thiết
        try {
            $parentProducts = ParentProduct::with(
                'categories',
                'products',
            )->get(['id', 'name', 'desc', 'short_desc', 'avatar', 'rating', 'categories_id']);

            if (!empty($parentProducts)) {
                $result = $parentProducts->map(function ($parentProduct) {
                    // Tìm sản phẩm có giá thấp nhất trong các phẩm con
                    if (!empty($parentProduct->products)) {
                        $minProductPrice = $parentProduct->products->sortBy('price_sale')->first();
                    }
                    // định dạng lại dữ liệu trả về
                    return [
                        'id' => $parentProduct->id,
                        'name' => $parentProduct->name,
                        'desc' => $parentProduct->desc,
                        'short_desc' => $parentProduct->short_desc,
                        'avatar' => $parentProduct->avatar,
                        'rating' => $parentProduct->rating,
                        'price_sale' => $minProductPrice->price_sale ?? 0,
                        'price' => $minProductPrice->price ?? 0,
                        'category' => [
                            'id' => $parentProduct->categories->id,
                            'name' => $parentProduct->categories->name ?? 'N/A',
                        ]
                    ];
                });
                return response()->json(
                    [
                        'success' => true,
                        'message' => "Lấy thành công danh sách sản phẩm",
                        'data' => $result,
                    ],
                    200
                );
            }
            return response()->json(
                [
                    'success' => true,
                    'message' => "Lấy thành công danh sách sản phẩm",
                    'data' => "Không có sản phẩm nào trong cơ sở dữ liệu!",
                ],
                200
            );
        } catch (QueryException $exception) {
            return response()->json([
                'success' => false,
                'error' => "Lỗi máy chủ!"
            ], 500);
        }
    }
}
