<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ordene.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:44:11pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Ordene extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'ordenes';

	public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function direccion()
    {
        return $this->belongsTo(Direccione::class, 'direccione_id');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }


}
