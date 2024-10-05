<?php

namespace App\Http\Controllers\client\cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartModel;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClientCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = JWTAuth::parseToken();

        $carts = CartModel::where('user_id', $user)->all();
        if($carts->isEmpty()){
            return response()->json(['message' => 'Không có sản phẩm trong giỏ hàng của bạn'], 404);
        }
        return response()->json($user,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1',
            ]); 
            $cart = CartModel::create($validatedData);
             
            return response()->json([
                'success' => true,
                'data' => $cart,
                'message' => 'Thêm sản phẩm vào giỏ hàng thành công!'
            ], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Đã xảy ra lỗi trong quá trình tạo giỏ hàng!', 'error' => $e->getMessage()], 500);
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
        try{
            $validatedData = $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);
            $cart = CartModel::findOrFail($id);
            $cart->update(['quantity' => $request->quantity]);
            return response()->json([
                'success' => true,
                'data' => $cart,
                'message' => 'Cập nhật số lượng giỏ hàng thành công!'
            ], 200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Đã xảy ra lỗi trong quá trình cập nhật số lượng giỏ hàng!', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $cart = CartModel::findOrFail($id);
            $cart->delete();
            return response()->json([
                'success' => true,
                'message' => 'Xóa sản phẩm khỏi giỏ hàng thành công!'
            ], 200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Đã xảy ra lỗi trong quá trình xóa sản phẩm khỏi giỏ hàng!', 'error' => $e->getMessage()], 500);
    }
    }
}
