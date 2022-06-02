<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    protected $guarded = [];
    //protected $fillable = ['title', 'excerpt', 'body'];
    // protected $guarded = ['id'];


    //Eager load  always. 
    protected $with = ['category', 'author'];


    //Eleqouent relationship. 
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //Eleqouent relationship. 
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(fn ($query) =>
            $query->where('title', 'like', '%' . $search . '%')
                ->orwhere('body', 'like', '%' . $search . '%'));
        });
        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', fn ($query) => $query->where('slug', $category));
        });
        $query->when($filters['author'] ?? false, function ($query, $author) {
            $query->whereHas('author', fn ($query) => $query->where('username', $author));
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
