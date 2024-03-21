<?php

namespace App\Models\EasyCooking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'ec_recipe';
    protected $fillable = [
        'categoryid',
        'postid',
        'name',
        'imageurl',
        'method',
        'seen',
        'fav',
        'isdelete'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryid');
    }

    const TableName = 'ec_recipe';
}
