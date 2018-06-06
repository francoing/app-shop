<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    public function product()
    {
        return $this->belongsTo(Product::class);


    }

    //accessor
    //Campo calculado para la url de una imagen 
    // si la url de la imagen comienza con http me la muestra a la imagen
    //y si es una imagen local me la manda a la ruta con su nombre de archivo 

    public function getUrlAttribute()
    {
        if (substr($this->image ,0,4)=="http"){
            return $this->image;
        }
        return '/images/products/' . $this->image;
    }
}
