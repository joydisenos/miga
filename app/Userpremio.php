<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userpremio extends Model
{
    protected $table = 'userpremios';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function premio()
    {
    	return $this->belongsTo(Premio::class);
    }
    public function direccion()
    {
    	return $this->belongsTo(Direccione::class,'direccione_id');
    }
}
