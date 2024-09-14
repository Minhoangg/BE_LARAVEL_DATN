<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;



class post_categories extends Model
{
    use HasFactory;
    /**
     * Quan hệ với bảng posts.
     * Một danh mục có thể có nhiều bài viết.
     */
    public function posts()
    {
        return $this->hasMany(post::class, 'category_id');
    }
}
