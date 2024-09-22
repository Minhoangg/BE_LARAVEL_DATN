<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class post_categories extends Model
{
    use HasFactory;

    /**
     * Tên bảng được sử dụng bởi model.
     *
     * @var string
     */
    protected $table = 'post_categories';

    /**
     * Các thuộc tính có thể được gán hàng loạt.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Quan hệ với bảng posts.
     * Một danh mục có thể có nhiều bài viết.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   
    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
