<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    const CREATED_AT = 'posted_at';
    const UPDATED_AT = 'updated_at';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
