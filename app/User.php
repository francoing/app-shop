<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Cart;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','address','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function carts(){

        return $this->hasMany(cart::class);
    }

    //funcion que me devuelve el id del carrito que se encuentre en estado activo
   public function getCartAttribute()
   {
       $cart=$this->carts()->where('status','Active')->first();
       if($cart)
       {
           return $cart;
       }
       //else
       //si no hay un carrito activo me crea uno lo pone en activo y le asigna el id
       $cart = new Cart();
       $cart->status = 'Active';
       $cart ->user_id= $this->id;
       $cart->save();

       return $cart;
   }
}
