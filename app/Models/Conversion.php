<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_name',
        'audio_path',
        'summary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
