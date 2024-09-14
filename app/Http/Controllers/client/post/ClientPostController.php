<?php

namespace App\Http\Controllers\client\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ClientPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            if ($search) {
                $posts = Post::where('title', 'like', '%' . $search . '%')->get();
            } else {
                $posts = Post::with([
                    'author:id,username', // Chỉ lấy cột 'id' và 'name' từ bảng 'admin_accounts'
                    'category:id,name' // Chỉ lấy cột 'id' và 'name' từ bảng 'post_categories'
                ])->get();
            }
            return response()->json([
                'success' => true,
                'data' => $posts,
                'message' => 'Danh sách bài viết đã được tải thành công!'
            ], 200); // HTTP Status 200: OK
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình tải danh sách!',
                'error'=>$e->getMessage()
            ],500);

        }


    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return response()->json
        ([
            'success'=>true,
            'data' =>$post,
            'message'=> "Tải thành công",
        ],200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
