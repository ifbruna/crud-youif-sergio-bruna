<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description'
    ];

    public function users()
    {
        return $this
            ->hasMany(User::class);
    }

    public function medias()
    {
        return $this
            ->hasMany(Media::class);
    }

    protected static function booted(): void
{
    static::deleting(function (Subject $subject) {
        if (! $subject->isForceDeleting()) {
            $subject->medias()->delete();
            $subject->users->each->delete();
        }
    });

    static::restoring(function (Subject $subject) {
        $subject->medias()->onlyTrashed()->restore();
        $subject->users()->onlyTrashed()->get()->each->restore();
    });
}
}
