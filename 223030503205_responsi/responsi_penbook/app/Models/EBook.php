<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EBook extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'author', 'category', 'price', 'image', 'published'];

    // Add relationships or custom methods here

    /**
     * Get the formatted category.
     *
     * @return string
     */
    public function getCategoryAttribute($value)
    {
        return ucfirst($value);
    }
}
