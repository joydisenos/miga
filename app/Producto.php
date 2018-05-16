<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Producto.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:52:12pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Producto extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'productos';

    public function compra()
    {
        return $this->hasMany(Compra::class);
    }
	
}
