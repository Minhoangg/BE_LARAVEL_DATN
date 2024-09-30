<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminAccountModel;
use App\Models\post_categories;
class Post extends Model
{
    protected $table = 'posts';
    use HasFactory;
    protected $fillable = ['title', 'id_admin_account', 'category_id', 'tag', 'content', 'author','image'];



    public function comments()
{
    return $this->hasMany(CommentPost::class, 'post_id');
}   
    /**
     * Quan hệ với bảng admin_accounts (Author).
     * Mỗi bài viết thuộc về một tác giả.
     */
    
    public function author()
    {
        return $this->belongsTo(AdminAccountModel::class, 'id_admin_account');
    }

    /**
     * Quan hệ với bảng post_categories (Category).
     * Mỗi bài viết thuộc về một danh mục.
     */
    public function category()
    {
        return $this->belongsTo(post_categories::class, 'category_id');
    }

}