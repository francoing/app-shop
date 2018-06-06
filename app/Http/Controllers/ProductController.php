<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{

    public function show($id){

       $product= Product::find($id);

       //aqui se realizara una logica para acomodar las imagenes de mi vista show 
       //a la izquierda o a la derecha iterando con  un for donde cada imagen tendra una clave key
       //y diciendo si es par se acomodara a la izquierda caso contrario ira a la derecha

       $images= $product->images;

       $imagesLeft= collect();
       $imagesRight= collect();
        
            foreach ($images as $key => $image) {
               if ($key%2) {
                   $imagesLeft->push($image);
               } else {
                   $imagesRight->push($image);
               }
               
            }
        return view('products.show')->with(compact('product','imagesLeft','imagesRight'));
    }
    
}
