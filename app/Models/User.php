<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;
    const ADMIN_ROLE_ID = 1; //admin user
    const USER_ROLE_ID = 2; //regular user

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 自分がbookmarkしている
    public function bookmarked() {
        return $this->hasMany(Bookmark::class, 'user_id');
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Post::class, 'bookmarks')->withPivot('user_id', 'post_id');
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }
    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    //when the user is soft deleted, the user's posts are also soft deleted.
    public static function boot()
    {
        parent::boot();

        static::deleted(function ($user) {
            $user->posts()->delete();
        });

        static::restored(function ($user) {
            $user->posts()->restore();
        });
    }
}
