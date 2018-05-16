<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dato.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:40:12pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Dato extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    protected $table = 'datos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

	
}
