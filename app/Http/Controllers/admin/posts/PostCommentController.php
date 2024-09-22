<?php

namespace App\Http\Controllers\admin\posts;
    
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommentPost;
use Illuminate\Support\Facades\Auth;
 
class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $perPage = $request->input('per_page', 10); // Số lượng bình luận trên mỗi trang

            $query = CommentPost::with('user', 'post', 'status');

            if ($search) {
                $query->where('content', 'like', '%' . $search . '%');
            }

            $commentPosts = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $commentPosts,
                'message' => 'Danh sách bình luận đã được tải thành công!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình tải danh sách!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Method not implemented
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'post_id' => 'required|exists:posts,id',
                'user_id' => 'required|exists:users,id',
                'content' => 'required|string',
                'id_status_comment' => 'required',
                'parent_id' => 'nullable|exists:comment_posts,id',
            ]);

            $commentPost = CommentPost::create($validatedData);
           
            return response()->json([
                'success' => true,
                'data' => $commentPost,
                'message' => 'Bình luận đã được tạo thành công!'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình tạo bình luận!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function reply(Request $request, $commentId)

    {
        try {
            $parentComment = CommentPost::findOrFail($commentId);

            $validatedData = $request->validate([
                'content' => 'required|string',
            ]);

            $replyComment = new CommentPost([
                'content' => $validatedData['content'],
                'post_id' => $parentComment->post_id,
                'user_id' => 1, //Auth::id(),  Sử dụng ID của người dùng đang đăng nhập
                'parent_id' => $commentId,
                'id_status_comment' => 1, // Giả sử 1 là trạng thái "Đã phê duyệt"
            ]);

            $replyComment->save();

            return response()->json([
                'success' => true,
                'data' => $replyComment,
                'message' => 'Đã trả lời bình luận thành công!'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình trả lời bình luận!',
                'error' => $e->getMessage()
            ], 500);
        }
    }   
        
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $commentPost = CommentPost::with('user', 'post', 'status')->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $commentPost,
                'message' => 'Bình luận đã được tải thành công!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy bình luận.',
                'error' => $e->getMessage()
            ], 404);
        }
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
        try {
            $validatedData = $request->validate([
                'content' => 'required|string',
                'id_status_comment' => 'required|exists:status_comment_posts,id',
            ]);

            $commentPost = CommentPost::findOrFail($id);
            $commentPost->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Bình luận đã được cập nhật thành công!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình cập nhật bình luận!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $commentPost = CommentPost::findOrFail($id);
            $commentPost->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bình luận đã được xóa thành công!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình xóa bình luận!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Soft delete the specified resource.
     */
    // public function softDelete(string $id)
    // {
    //     try {
    //         $commentPost = CommentPost::findOrFail($id);

    //         // Kiểm tra quyền xóa mềm
    //         if (!Auth::user()->can('softDelete', $commentPost)) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Bạn không có quyền xóa mềm bình luận này!'
    //             ], 403);
    //         }

    //         $commentPost->softDelete();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Bình luận đã được xóa mềm thành công!'
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Đã xảy ra lỗi trong quá trình xóa mềm bình luận!',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    // /**
    //  * Restore a soft deleted resource.
    //  */
    // public function restore(string $id)
    // {
    //     try {
    //         $commentPost = CommentPost::withTrashed()->findOrFail($id);

    //         // Kiểm tra quyền khôi phục
    //         if (!Auth::user()->can('restore', $commentPost)) {
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Bạn không có quyền khôi phục bình luận này!'
    //             ], 403);
    //         }

    //         $commentPost->restore();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Bình luận đã được khôi phục thành công!'
    //         ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Đã xảy ra lỗi trong quá trình khôi phục bình luận!',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
