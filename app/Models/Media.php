<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Media extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'medias';
    const CREATED_AT = 'posted_at';
    const UPDATED_AT = 'updated_at';

    public function user()
    {
        return $this->
            belongsTo(User::class, 'author_id');
    }

    public function users()
    {
        return $this
            ->belongsToMany(User::class, 'play')
            ->withPivot('last_time_played', 'is_liked');
    }
}
