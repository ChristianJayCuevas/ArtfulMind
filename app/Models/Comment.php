<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\post;

class Comment extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    public function post() 
    {
        return $this->belongsTo(post::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
