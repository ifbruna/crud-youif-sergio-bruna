<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
  use HasFactory, SoftDeletes;
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

    public function subject()
    {
        return $this
            ->belongsTo(Subject::class);
    }

    protected static function booted(): void
{
    static::deleting(function (User $user) {
        if (! $user->isForceDeleting()) {
            $user->createdMedia()->delete();
        }
    });

    static::restoring(function (User $user) {
        $user->createdMedia()->onlyTrashed()->restore();
    });
}
}
