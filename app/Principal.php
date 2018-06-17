<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    protected $table = 'principal';

    protected $fillable = [

    	'envio', 
    	'descuento', 
    	'monto',
    	'lunesa',
    	'lunesc',
    	'martesa',
    	'martesc',
    	'miercolesa',
    	'miercolesc',
    	'juevesa',
    	'juevesc',
    	'viernesa',
    	'viernesc',
    	'sabadoa',
    	'sabadoc',
    	'domingoa',
    	'domingoc',
    	'lunesat',
    	'lunesct',
    	'martesat',
    	'martesct',
    	'miercolesat',
    	'miercolesct',
    	'juevesat',
    	'juevesct',
    	'viernesat',
    	'viernesct',
    	'sabadoat',
    	'sabadoct',
    	'domingoat',
    	'domingoct',
    	'bienvenida',
        'msjfront',
        'msjuser'
    ];
  	
  	protected $guarded = ['id'];
}
