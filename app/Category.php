<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    //declaramos este metodo protected para decir que atributos le corresponden a category
    protected $fillable = ['name','description'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static $messages =[
        'name.required'=>'Es necesario ingresar el nombre para el producto.',
        'name.min'=>'El nombre del producto debe tener al menos 3 caracteres.',
        'description.max'=>'La descripcion de este producto no puede tener mas de 200 caracteres.',
        



    ];
    
    //validacion de los datos en el formulario de creacion de un producto
    public static $rules =[
        'name'=>'required|min:3',
        'description'=>'max:200',
       
    ];
}
