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
use App\Http\Controllers\client\product\ProductController;



class ClientCartController extends Controller
{
    protected $productController;

    // Inject ProductController thông qua constructor
    public function __construct(ProductController $productController)
    {
        $this->productController = $productController;
    }
    
    public function index()
{   $user = Auth::user();
    if ($user) {
        $cartItems = CartModel::where('user_id', $user->id)->get();
        $pd = []; 
        foreach ($cartItems as $item) {
            $productDetailsResponse = $this->productController->detail($item->product_id);
            $productDetails = $productDetailsResponse->getData();
            if ($productDetails && isset($productDetails->data)) {
                
                $productDetails->data->quantity = $item->quantity;
                $productDetails->data->id = $item->id;
                $pd[] = $productDetails;
              
            }
        }
        return response()->json([
            'status' => true,
            'cart' => $pd, 
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Bạn Chưa Đăng Nhập!'
        ], 401); 
    }
}
 public function store(Request $request)
    {
        $request->validate(
            [
                'product_id' => 'required',
                'quantity' => 'required|integer|min:1',
            ]
        );

        

        if (auth()->check()) {
            $product = Product::find($request->product_id);
            if (!$product) {
                return response()->json(['message' => 'Sản phẩm Không tồn tại'], 404);
            }
            if ($request->quantity > $product->quantity) { 
                return response()->json(['message' => 'Số lượng sản phẩm không đủ'], 400);
            }
            $cart = CartModel::where('user_id', auth()->id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($cart) {
                if ($cart->quantity + $request->quantity > $product->quantity) {
                    return response()->json(['message' => 'Số lượng sản phẩm không đủ '], 400);
                }
                $cart->quantity += $request->quantity;
                $cart->save();
            } else {
                CartModel::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);


            }
            return response()->json(['message' => 'Sản phẩm đã được thêm vào giỏ hàng']);


        } else {
            return response()->json([
                'status' => false,
                'message' => 'Bạn Chưa Đăng Nhập!'
            ], 401); 
        }
    }

   
     
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
        // $validatedData = $request->validate([
        //     'quantity' => 'required|integer|min:1',
        // ]);
        if (Auth()->check()) {
            try {
                // Tìm giỏ hàng và cập nhật số lượng trong CSDL
                $cart = CartModel::findOrFail($id);
                $product = Product::findOrFail($cart->product_id);
            
                // Kiểm tra số lượng mới có vượt quá số lượng có sẵn không
                if ($request->quantity > $product->quantity) {
                    return response()->json([
                        'message' => 'Số lượng sản phẩm chỉ còn '.$product->quantity,
                    ], 400);
                }
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
            return response()->json([
                'status' => false,
                'message' => 'Bạn Chưa Đăng Nhập!'
            ], 401); 
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
            return response()->json([
                'status' => false,
                'message' => 'Bạn Chưa Đăng Nhập!'
            ], 401); 
        }
    }
}
