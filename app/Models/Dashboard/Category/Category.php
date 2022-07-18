<?php

namespace App\Models\Dashboard\Category;

use App\Models\Dashboard\Post\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // ===== Public constants
    public const VALIDATION_RULES = [
        'name' => 'required|string'
    ];

    // ===== Relationships
    public function posts() {
        return $this->hasMany(Post::class);
    }
}
