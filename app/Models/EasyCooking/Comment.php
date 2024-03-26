<?php

namespace App\Models\easycooking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "content",
        "user_id",
        "post_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
