<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function dato()
    {
        return $this->hasOne(Dato::class);
    }

    public function direccion()
    {
        return $this->hasMany(Direccione::class);
    }

    public function compra()
    {
        return $this->hasMany(Compra::class);
    }

    public function ordenes()
    {
        return $this->hasMany(Ordene::class);
    }

    public function premio()
    {
        return $this->hasMany(Userpremio::class);
    }

    public function cupon()
    {
        return $this->hasMany(Cuponesuser::class);
    }
}
