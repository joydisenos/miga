<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Compra.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:47:14pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Compra extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'compras';

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
}
