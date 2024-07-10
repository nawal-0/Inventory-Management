<?php

namespace App\Models;

use SDamian\Larasort\AutoSortable;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory, AutoSortable;

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
    public $sortables = [
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

