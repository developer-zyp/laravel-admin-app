<?php

namespace App\Models\easycooking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EasyCooking\Comment;
use App\Models\EasyCooking\Like;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "content",
        "user_id",
        "image",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
