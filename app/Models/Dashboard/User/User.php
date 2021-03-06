<?php

namespace App\Models\Dashboard\User;

use App\Models\Dashboard\Post\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin',
        'isMember',
        'status',
        'phone'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Helper functions
    public static function getUsers() {
        return User::withoutTrashed()->select(['id', 'name', 'email', 'status', 'isAdmin', 'isMember'])->paginate(15);
    }

    public static function getMembers() {
        return User::where('isMember', 1)->withoutTrashed()->select(['id', 'name', 'email', 'status', 'isAdmin', 'isMember'])->paginate(15);
    }

    public static function updateData($user, $data) {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'isAdmin' => $data['isAdmin'],
            'isMember' => $data['isMember'],
            'status' => $data['status'],
            'phone' => $data['phone'],
        ]);

        if(isset($data['password'])) {
            $user->update([
                'password' => bcrypt($data['password'])
            ]);
        }
    }

    public static function storeData($data) {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'isAdmin' => $data['isAdmin'],
            'isMember' => $data['isMember'],
            'status' => $data['status'],
        ]);
    }

    public static function returnAdmins() {
        return User::where('isAdmin', 1)->select(['id', 'name'])->get();
    }

    // Constants
    public const VALIDATION_RULES = [
        'name' => 'required|string|min:3',
        'email' => 'required|string|email',
        'phone' => 'nullable|string',
        'isAdmin' => 'required|boolean',
        'isMember' => 'required|boolean',
        'status' => 'required|integer',
        'password' => 'required|confirmed|min:6'
    ];


    // Relationships
    public function posts() {
        return $this->hasMany(Post::class);
    }
}
