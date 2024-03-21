<?php

namespace App\Models\EasyCooking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'ec_category';
    protected $fillable = [
        'name',
        'imageurl',
        'type',
        'isdelete'
    ];

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'id');
    }

    const TableName = 'ec_category';
}
