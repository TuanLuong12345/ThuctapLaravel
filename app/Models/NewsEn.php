<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsEn extends Model
{
    use SoftDeletes;

    protected $table = 'news_en';

    protected $fillable = [
        'user_id',
        'new_id',
        'title',
        'thumbnail',
        'content',
        'status',
        'banner',
        'public_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function news()
    {
        return $this->belongsTo(News::class, 'new_id');
    }
}
