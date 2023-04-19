<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'title',
        'description',
        'image'
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];



    public function comments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
