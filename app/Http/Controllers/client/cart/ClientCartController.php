<?php

namespace App\Http\Controllers\client\cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartModel;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\VariantAttribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;



class ClientCartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = [];

        if ($user) {
            $cartItems = CartModel::where('user_id', $user->id)
                ->with('product', 'productVariant.variantAttribute')->get();

                foreach ($cartItems as $item) {
                    if ($item->id_variant) {
                        $variant = ProductVariant::find($item->id_variant);
                        $variantAttribute = $variant->variantAttribute;
                        $cart[] = [
                            'id' => $item->id,
                            'product_id' => $item->product_id,
                            'id_variant' => $item->id_variant,
                            'quantity' => $item->quantity,
                            'product' => [
                                'id' => $item->product->id,
                                'name' => $item->product->name,
                                'price' => $item->product->price,
                                'avatar' => $item->product->avatar,
                                'private_desc' => $item->product->private_desc,
                            ],
                            'variant_attribute' => $variantAttribute ? [
                                'id' => $variantAttribute->id,
                                'name' => $variantAttribute->name,
                                'color_code' => $variantAttribute->color_code,
                                'created_at' => $variantAttribute->created_at,
                                'updated_at' => $variantAttribute->updated_at,
                            ] : null,
                        ];
                    } else {
                    $cart[] = [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'variant_id' => $item->variant_id,
                        'product' => [
                            'id' => $item->product->id,
                            'name' => $item->product->name,
                            'price' => $item->product->price,
                            'avatar' => $item->product->avatar,
                            'private_desc' => $item->product->private_desc,
                        ],
                        'variant_attribute' => null,
                    ];
                }
            }
        } else {
            // Lấy giỏ hàng từ cookie
            $cart = json_decode(request()->cookie('cart'), true) ?? [];
            if ($cart) {
                foreach ($cart as &$item) {
                    // Lấy thông tin sản phẩm từ Product
                    $product = Product::find($item['product_id']);
                    // Lấy thông tin product variant từ ProductVariant
                    $variant = ProductVariant::find($item['variant_id']);

                    if ($product) {
                        $item['product'] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'price' => $product->price,
                            'avatar' => $product->avatar,
                            'private_desc' => $product->private_desc,
                        ];
                    }
                    if ($variant) {
                        $variantAttribute = $variant->variantAttribute;
                        $item['productVariant'] = [
                            'variant_attribute' => $variantAttribute ? [
                                'id' => $variantAttribute->id,
                                'name' => $variantAttribute->name,
                                'color_code' => $variantAttribute->color_code,
                                'created_at' => $variantAttribute->created_at,
                                'updated_at' => $variantAttribute->updated_at,
                            ] : null,
                        ];
                    }
                }
            } else {
                return response()->json(['message' => 'Không có sản phẩm trong giỏ hàng!'], 200);
            }
        }
        // Tính tổng giá trị giỏ hàng
        $total = array_reduce($cart, function ($carry, $item) {
            // Prioritize variant price, fallback to product price
            $price = $item['productVariant']['price'] ?? $item['product']['price'] ?? 0;
            return $carry + ($item['quantity'] * $price);
        }, 0);
        $totals = number_format($total, 0, '.', '.');

        return response()->json([
            'cart_items' => $cart,
            'total_price' => $totals,
        ]);
    }
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate(
            [
                'product_id' => 'required',
                'quantity' => 'required|integer|min:1',
            ]
        );

        // Check if the user is logged in
        if (auth()->check()) {
            // Kiểm tra sản phẩm có tồn tại không
            $product = Product::find($request->product_id);
            if (!$product) {
                return response()->json(['message' => 'Sản phẩm Không tồn tại'], 404);
            }
            // Tìm giỏ hàng với điều kiện trùng user_id, product_id 
            $cart = CartModel::where('user_id', auth()->id())
                ->where('product_id', $request->product_id)
                ->where('id_variant', $request->id_variant)
                ->first();

            if ($cart) {
                // Nếu đã tồn tại, cập nhật số lượng
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                // Nếu không tồn tại, tạo mới (id sẽ tự động được tạo)
                CartModel::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id,
                    'id_variant' => $request->id_variant,
                    'quantity' => $request->quantity,
                ]);


            }
            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng']);


        } else {
            $cart = json_decode($request->cookie('cart'), true) ?? [];
            $productExists = false;

            $counter = 1;
            // Duyệt qua các item trong giỏ hàng để kiểm tra xem sản phẩm và variant đã tồn tại chưa
            foreach ($cart as &$item) {
                if ($item['product_id'] == $request->product_id) {
                    if ($item['variant_id'] == $request->variant_id) {
                        // Nếu product_id và variant_id trùng, cập nhật số lượng
                        $item['quantity'] += $request->quantity;
                        $productExists = true; // Đánh dấu là sản phẩm với variant này đã tồn tại
                        break; // Không cần kiểm tra thêm
                    }
                }
                $counter++; // Increment the counter for each item
            }

            // Nếu sản phẩm với variant_id không tồn tại, thêm mới vào giỏ hàng
            if (!$productExists) {
                $product = Product::find($request->product_id);  // Lấy sản phẩm từ DB
                if (!$product) {
                    return response()->json(['message' => 'Sản phẩm không tồn tại!'], 404);
                }

                // Thêm sản phẩm và variant_id mới vào giỏ hàng
                $cart[] = [
                    'id' => $counter, // Assign the counter to id
                    'product_id' => $request->product_id,
                    'variant_id' => $request->variant_id, // Thêm variant_id vào giỏ hàng
                    'quantity' => $request->quantity,
                ];
            }

            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng'])
                ->cookie('cart', json_encode($cart), 10080);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        if (Auth()->check()) {
            try {
                // Tìm giỏ hàng và cập nhật số lượng trong CSDL
                $cart = CartModel::findOrFail($id);
                $cart->update(['quantity' => $request->quantity]);

                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật số lượng giỏ hàng thành công!'
                ], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Đã xảy ra lỗi trong quá trình cập nhật số lượng giỏ hàng!',
                    'error' => $e->getMessage()
                ], 500);
            }
        } else {
            // Nếu chưa đăng nhập, cập nhật số lượng trong cookie
            $cart = json_decode($request->cookie('cart'), true) ?? []; // Lấy giỏ hàng từ cookie

            $productExists = false;

            foreach ($cart as &$item) {
                if ($item['product_id'] == $id && $item['variant_id'] == $request->id_variant) {
                    $item['quantity'] += $request->quantity;
                    $productExists = true;
                    break;
                }
            }

            // Nếu sản phẩm không tồn tại trong giỏ hàng
            if (!$productExists) {
                return response()->json(['message' => 'Sản phẩm không tồn tại trong giỏ hàng!'], 404);
            }

            // Lưu giỏ hàng đã cập nhật lại vào cookie
            return response()->json(['message' => 'Sản phẩm đã được cập nhật trong giỏ hàng'])
                ->cookie('cart', json_encode($cart), 10080); // 10080 minutes = 7 days
        }
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            // Xóa khỏi DB nếu đã đăng nhập
            $cart = CartModel::where('id', $id)->where('user_id', Auth::id())->first();
            if ($cart) {
                $cart->delete();
                return response()->json(['message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!']);
            } else {
                return response()->json(['message' => 'Sản phẩm không tồn tại trong giỏ hàng!'], 404);
            }
        } else {
            // Xóa khỏi cookie nếu chưa đăng nhập
            $cartItems = json_decode(request()->cookie('cart', '[]'), true) ?? []; // Lấy giỏ hàng từ cookie

            // Kiểm tra xem giỏ hàng có rỗng không
            if (empty($cartItems)) {
                return response()->json(['message' => 'Giỏ hàng rỗng!'], 404);
            }

            $productExists = false;

            // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
            foreach ($cartItems as &$item) {
                if (isset($item['id']) && $item['id'] == $id) {
                    $productExists = true;
                    break;
                }
            }

            // Nếu sản phẩm tồn tại, tiến hành xóa
            if ($productExists) {
                $cart = array_filter(
                    $cartItems,
                    function ($item) use ($id) {
                        return isset($item['id']) && $item['id'] != $id; // Lọc sản phẩm cần xóa
                    }
                );
                Cookie::queue('cart', json_encode(array_values($cart)), 60 * 24 * 7); // Cập nhật cookie
            } else {
                return response()->json(['message' => 'Sản phẩm không tồn tại trong giỏ hàng!'], 404);
            }
            return response()->json(['message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!'])
                ->cookie('cart', json_encode(array_values($cart)), 60 * 24 * 7); // Đảm bảo cookie mới được lưu lại
        }
    }
}
