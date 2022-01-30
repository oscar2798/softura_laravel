<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    
    protected $fillable = [
        'id','nombre','puesto','edad','antiguedad','estado','sueldo','moneda'
    ];
}
