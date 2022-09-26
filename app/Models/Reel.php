<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reel extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'reel_path','place_id', 'tags'];

    protected $casts = [
        'reel_path' => 'encrypted',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function places()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }
}
