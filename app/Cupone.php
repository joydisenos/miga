<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cupone.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:48:38pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Cupone extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'cupones';

	
}
