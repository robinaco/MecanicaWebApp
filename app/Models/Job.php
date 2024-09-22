<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;


    protected $casts = [
        'conceptowork' => 'array',
        'describework' => 'array',
        'cantidadwork' => 'array',
        'valorwork' => 'array',
    ];

    protected $fillable = [
        'conceptowork',
        'describework',
        'cantidadwork',
        'valorwork',
        'idvehiculo',
    ];
}
