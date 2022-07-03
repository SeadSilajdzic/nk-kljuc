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
        'title',
        'short_description',
        'description',
        'image',
        'images',
        'slug'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
