<?php

namespace App\Http\Controllers\admin\posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post_categories as PostCategory;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Admin\Post\PostCateRequest;
use App\Models\Post;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $categories = $search
                ? PostCategory::where('name', 'like', '%' . $search . '%')->get()
                : PostCategory::all();

            return response()->json([
                'success' => true,
                'data' => $categories,
                'message' => 'Danh sách danh mục bài viết đã được tải thành công!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình tải danh sách danh mục!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public
    function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCateRequest $request)
    {
        try {
            // Dữ liệu đã được xác thực và hợp lệ
            // Tạo danh mục bài viết mới
            $postCategory = PostCategory::create($request->validated());
            return response()->json([
                'success' => true,
                'data' => $postCategory,
                'message' => 'Danh mục bài viết đã được tạo thành công!'
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu nhập không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi không mong muốn',
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
            $postCategory = PostCategory::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $postCategory,
                'message' => 'Danh mục bài viết đã được tải thành công!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy danh mục bài viết.',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Phương thức này không cần thiết trong API, có thể xóa hoặc để trống
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostCateRequest $request, string $id)
    {
        try {
            // Tìm danh mục bài viết theo ID hoặc trả về lỗi 404 nếu không tìm thấy
            $postCategory = PostCategory::findOrFail($id);

            // Kiểm tra xem có sự thay đổi trong dữ liệu không
            $validatedData = $request->validated();
            
            if ($postCategory->update($validatedData)) {
                return response()->json([
                    'success' => true,
                    'data' => $postCategory,
                    'message' => 'Danh mục bài viết đã được cập nhật thành công!'
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Không có thay đổi nào được thực hiện.'
                ], 200);
            }
        } catch (ValidationException $e) {
            // Xử lý lỗi validation nếu có
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu nhập không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình cập nhật',
                'error' => $e->getMessage()
            ], 500); // HTTP Status 500: Internal Server Error
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $postCategory = PostCategory::findOrFail($id);
            
            // Kiểm tra xem danh mục có bài viết không
            if ($postCategory->posts()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể xóa danh mục này vì còn chứa bài viết.'
                ], 400);
            }

            $postCategory->delete();
            return response()->json([
                'success' => true,
                'message' => 'Danh mục bài viết đã được xóa thành công!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi trong quá trình xóa danh mục.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
