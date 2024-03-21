<?php

namespace App\Models\EasyCooking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoEat extends Model
{
    use HasFactory;
    protected $table = 'ec_noeat';
    protected $fillable = [
        'id',
        'items', 
        'action',
        'status'
    ];

    const tableName = 'ec_noeat';
}
