<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'icon', 'icon_storage_type', 'parent_id', 'position', 'home_status', 'priority'
    ];

    // Recursive relationship to get children of a category
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Parent category relationship
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
