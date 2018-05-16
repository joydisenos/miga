<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Premio.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:49:55pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Premio extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'premios';

	
}
