<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Item extends Model
{
    use HasFactory, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category',
        'image',
        'description',
        'quantity',
    ];

    /**
     * The attributes that are sortable.
     *
     * @var array<int, string>
     */
    public $sortable = [
        'name',
        'category',
        'quantity',
    ];

    public static function getCategories()
    {
        return ['Category1', 'Category2', 'Category3', 'Category4', 'Category5'];
    }

    public function scopeFilter($query, array $filters)
    {
        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%');
        };
    }

    
} 

