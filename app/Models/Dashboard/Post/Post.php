<?php

namespace App\Models\Dashboard\Post;

use App\Models\Dashboard\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'short_description',
        'description',
        'image',
        'images',
        'slug',
        'subtitle',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public const VALIDATION_RULES = [
        'user_id' => 'required|integer',
        'title' => 'required|string',
        'short_description' => 'nullable|string',
        'description' => 'required|string',
        'image' => 'nullable|image',
        'images' => 'nullable',
        'slug' => 'nullable|string',
        'subtitle' => 'nullable|string',
        'status' => 'required|integer',
    ];

    public static function getPosts() {
        return Post::with(['user' => function($query) {
            $query->select(['id', 'name']);
        }])->orderBy('id', 'desc')->paginate(15);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
