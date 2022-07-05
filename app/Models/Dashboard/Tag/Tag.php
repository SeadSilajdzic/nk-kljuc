<?php

namespace App\Models\Dashboard\Tag;

use App\Models\Dashboard\Post\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public const VALIDATION_RULES = [
        'name' => 'required|string'
    ];

    public static function tags() {
        return Tag::select(['id', 'name'])->withCount('posts')->orderBy('id', 'desc')->paginate(15);
    }

    public function posts() {
        return $this->belongsToMany(Post::class);
    }
}
