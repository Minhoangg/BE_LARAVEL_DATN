<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentPost extends Model
{
    use HasFactory;
    protected $table = 'comment_posts';
    protected $fillable = ['content', 'post_id', 'user_id', 'id_status_comment','parent_id'];
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusCommentPost::class, 'id_status_comment');
    }
}
