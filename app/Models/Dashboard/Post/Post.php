<?php

namespace App\Models\Dashboard\Post;

use App\Models\Dashboard\Category\Category;
use App\Models\Dashboard\Tag\Tag;
use App\Models\Dashboard\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'short_description',
        'description',
        'image',
        'gallery_images',
        'slug',
        'subtitle',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // ===== Public constants
    public const VALIDATION_RULES = [
        'user_id' => 'required|integer',
        'category_id' => 'required|integer',
        'title' => 'required|string',
        'short_description' => 'nullable|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpg,jpeg,png,svg',
        'gallery_images' => 'nullable',
        'slug' => 'nullable|string',
        'subtitle' => 'nullable|string',
        'status' => 'required|integer',
    ];

    // ===== Helper functions
    public function getImageAttribute($image) {
        return asset($image);
    }

    public static function storeData($request) {
        $data = $request->validated();

        $file = $data['image'];
        $filename = time() . $file->getClientOriginalName();
        $file->storeAs('public/posts/', $filename);

        $post = Post::create([
            'user_id' => $data['user_id'],
            'category_id' => $data['category_id'],
            'title' => $data['title'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
            'image' => 'storage/posts/' . $filename,
            'slug' => Str::slug($data['title']),
            'subtitle' => $data['subtitle'],
            'status' => $data['status'],
        ]);

        if($request->tags) {
            $post->tags()->sync($request->tags);
        }
    }

    public static function getPosts() {
        return Post::select(['id', 'title', 'status', 'user_id', 'category_id'])->with(
            ['category' => function($category) {
                $category->select(['id', 'name']);
            }, 'user' => function($user) {
                $user->select(['id', 'name']);
            }]
        )->withCount('tags')->orderBy('id', 'desc')->paginate(15);
    }

    // ===== Relationships
    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
