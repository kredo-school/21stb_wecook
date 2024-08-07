<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'photo',
        'dish_id',
        'title',
        'cooking_time',
        'ingredients',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id'); 
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    // bookmark全体を取得
    public function bookmark()
    {
        return $this->hasMany(Bookmark::class);
    }

    // 自分のpostがbookmarkされている
    // Mybookmarkで使用★　$post->isBookmarked()
    public function isBookmarked() 
    {
        return $this->bookmark()->where('user_id', Auth::user()->id)->exists();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->withoutTrashed();
    }
    public function getCommentCountAttribute()
    {
        return $this->comments()->count();
    }
    public function index()
{
    $posts = Post::withTrashed()->get();
    return view('posts.index', compact('posts'));
}
    //     return $this->belongsTo(Dish::class);
    // }
    // detailrecipe pege
        public function getCategoryLabelAttribute()
    {
        $categories = [
            'appetizer' => 'Appetizer',
            'side_dish' => 'Side dish',
            'main_dish' => 'Main dish',
            'dessert' => 'Dessert'
        ];

        return $categories[strtolower($this->category)] ?? $this->category;
    }
    
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withPivot('user_id', 'post_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
