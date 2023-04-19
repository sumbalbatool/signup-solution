<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'post_id'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];


    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}

