<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculoEmp extends Model
{
    use HasFactory;
    protected $table = 'calculoemp';
    protected $fillable = ['fecharet', 'montodevengado', 'devengadobono', 'impuestoret', 'aguinaldoexen', 'aguinaldograv', 'afp', 'isss', 'inpep', 'ipsfa', 'cefafa', 'bienmagis', 'isssivm', 'empleado_id', 'codigoret_id'];
    public $timestamps = false;
}
