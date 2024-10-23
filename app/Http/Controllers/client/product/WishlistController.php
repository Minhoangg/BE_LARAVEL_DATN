<?php

namespace App\Http\Controllers\client\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Http\Controllers\client\product\ProductController;
use Illuminate\Support\Facades\Auth;


class WishlistController extends Controller
{
    protected $productController;


    public function __construct(ProductController $productController)
    {
        $this->productController = $productController;
    }
   
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $wishlist = Wishlist::where('user_id', auth()->id())->with('productWishlist')->get();
            $pd = [];
            foreach ($wishlist as $item) {
                $productDetailsResponse = $this->productController->detail($item->product_id);
                $productDetails = $productDetailsResponse->getData();
                if ($productDetails && isset($productDetails->data)) {
                    $productDetails->data->id = $item->id;
                    $pd[] = $productDetails;
                }
            }
            return response()->json([
                'status' => true,
                'wishlist' => $pd,
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

        $user = Auth::user();
        if($user){
            $request->validate([
                'product_id' => 'required|exists:products,id',
            ]);
    
            // Lấy user đang đăng nhập
            $userId = auth()->id();
    
            // Kiểm tra xem user_id có hợp lệ không
            if (is_null($userId)) {
                return response()->json([
                    'status' => false,
                    'message' => 'User ID không hợp lệ.'
                ], 401);
            }
             // Kiểm tra xem sản phẩm đã có trong wishlist chưa
             $existingWishlistItem = Wishlist::where('user_id', $userId)
             ->where('product_id', $request->product_id)
             ->first();
            if ($existingWishlistItem) {
                return response()->json([
                    'status' => false,
                    'message' => 'Sản phẩm đã có trong danh sách yêu thích.'
                ], 409); // 409 Conflict
            }
    
            $wishlist = Wishlist::firstOrCreate([
                'user_id' => $userId, // Sử dụng user_id của người dùng đang đăng nhập
                'product_id' => $request->product_id,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Product added to wishlist',
                'data' => $wishlist
            ], 201);

        }else {
            return response()->json([
                'status' => false,
                'message' => 'Bạn Chưa Đăng Nhập!'
            ], 401);
        }
     
    }
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        if($user){
            $request->validate([
                'product_id' => 'required|exists:products,id',
            ]);
    
            $wishlist = Wishlist::where('user_id', auth()->id())
                ->where('product_id', $id)
                ->first();
    
            if ($wishlist) {
                $wishlist->product_id = $request->product_id; // Cập nhật product_id
                $wishlist->save();
                return response()->json([
                    'status' => true,
                    'message' => 'Cập nhật danh sách yêu thích thành công',
                    'data' => $wishlist
                ], 200);
            }
    
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy mục trong danh sách yêu thích'
            ], 404);
        }else{
            return response()->json([
                'status' => false,
                'message' =>'bạn chưa đăng nhặp!'
            ],404);
        }
       
    }
    public function destroy(string $id)
    {
        $user = Auth::user();
        if($user){
            $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json([
                'status' => true,
                'message' => 'Sản Phẩm Đã Xóa Khỏi Danh Sách Yêu Thích'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Không Tìm Thấy Sản Phẩm Yêu Thích'
        ], 404);
        }
        else {
            return response()->json([
                'status' => false,
                'message' => 'Bạn Chưa Đăng Nhập!'
            ], 401);
        }
      
    }
}
