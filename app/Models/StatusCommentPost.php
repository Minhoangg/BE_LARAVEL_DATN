<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusCommentPost extends Model
{
    use HasFactory;
    protected $table = "status_comment_posts";
    protected $fillable = ['name'];

    
    public function status(){
        return $this->belongsTo(CommentPost::class, 'id_status_comment', 'id');
    }
}
