<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class latonerias extends Model
{
    use HasFactory;
    protected $fillable = ['idvehiculo','ordenl','descripcionservicio','cantidad','preciounidad','subtotal','estado'];

}
