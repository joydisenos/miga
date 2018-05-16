<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Direccione.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:42:36pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Direccione extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'direcciones';

	
	public function ordenes()
    {
        return $this->hasMany(Ordene::class);
    }
	
}
