<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'thumbnail',
        'content',
        'banner',
        'status',
        'public_at',

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function newsEn()
    {
        return $this->hasOne(NewsEn::class, 'new_id', 'id');
    }

}
