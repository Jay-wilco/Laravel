<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Word extends Model
{
    use HasFactory;

    protected $fillable = ['finnish', 'english', 'example', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
