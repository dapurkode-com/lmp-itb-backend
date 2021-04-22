<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ph extends Model
{
    use HasFactory;

    protected $fillable = ['microtime', 'ph'];
    protected $cast = [
        'ph' => 'integer',
        'microtime' => 'integer'
    ];
}