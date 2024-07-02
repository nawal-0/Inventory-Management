<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'description',
        'quantity',
    ];

    public static function getCategories()
    {
        return ['Category1', 'Category2', 'Category3', 'Category4', 'Category5'];
    }

    
} 

