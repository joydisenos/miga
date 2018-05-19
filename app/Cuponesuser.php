<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuponesuser extends Model
{
    protected $table = 'cuponesusers';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function cupon()
    {
    	return $this->belongsTo(Cupone::class);
    }
}
