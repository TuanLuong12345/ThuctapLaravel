<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'info';
    protected $fillable = ['title', 'thumbnail', 'content', 'type'];
}
