<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $casts = [
        'mecanico' => 'string',
        'idvehiculo' => 'string',
        'conceptomano'=> 'string',
        'describemano'=> 'string',
        'valormano'=> 'array',
        'ordenservicio'=> 'string',
       
    ];
  
    
    protected $fillable = [
        'conceptomano',
        'describemano',
        'valormano',
        'mecanico',
        'ordenservicio',
        'idvehiculo',
      
    ]; 
}
