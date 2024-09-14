<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class admin_accounts extends Model
{
    use HasFactory;
    /**
     * Quan hệ với bảng posts.
     * Một admin có thể viết nhiều bài viết.
     */
    public function posts()
    {
        return $this->hasMany(post::class, 'author_id');
    }
}
