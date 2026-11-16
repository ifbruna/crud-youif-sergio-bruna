<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
  use HasFactory, SoftDeletes;
  public static final String $DEFAULT_USER_IMAGE = "unknown_user.jpg";
    protected $fillable = [
        'email',
        'name',
        'password',
        'permission',
        'image'
    ];


    public function createdMedia()
    {
        return $this
            ->hasMany(Media::class, 'author_id');
    }

    public function playedMedia()
    {
        return $this
            ->belongsToMany(Media::class, 'play')
            ->withPivot('last_time_played', 'is_liked');
    }

    public function profileImage() {
        return User::getProfileImage($this->image);
    }

    public static function getProfileImage(?String $image) : String {
        return $image == null ? "assets/images/". User::$DEFAULT_USER_IMAGE : "storage/$image";
    }
}
