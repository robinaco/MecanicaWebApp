<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latoneria extends Model
{

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
    use HasFactory;
}
