<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function category()
    {
        return $this->belongsTo(Category::class);


    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);

    }
    // con este metodo evaluamos 

    public function getFeaturedImageUrlAttribute()
    {
        $featuredImage = $this ->images()->where('featured',true)->first();

        if(!$featuredImage){

              $featuredImage= $this->images()->first();

        }
      
        if($featuredImage)
        {
            return $featuredImage ->url;

        }
        return '/images/default.jpg';

    }
    //este es un metodo accesor que me dice si el nombre de la categoria existe devuelve su nombre si no le pone General como categoria
    public function getCategoryNameAttribute(){
        if ($this->category) {
            return $this->category->name;
        }
        return 'General';

        
    }
}
