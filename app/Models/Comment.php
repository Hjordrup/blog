<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['body', 'user_id'];
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //if reference column is not called the function named you need to pass the column new as a second variable
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
