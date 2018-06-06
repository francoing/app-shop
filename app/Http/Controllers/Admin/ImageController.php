<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;

class ImageController extends Controller
{
    public function index($id){

        $product = Product::find($id);
        $images = $product->images()->orderBy('featured','desc')->get();

        return view ('admin.products.images.index')->with(compact('product','images'));

    }
    public function store(Request $request, $id){


        //guardar la imagen en nuestro proyecto
        $file = $request->file('photo');//guardamos la imagen en la variable file
        $path =public_path() . '/images/products/';//public_path es la ruta absoluta a la carpeta public y a eso le estamos concatenando /images/products 
        $fileName = uniqid(). $file->getClientOriginalName();// definimos un nombre para el archivo que se compone de un id unico concatenado con el nombre original del archivo
        //$file -> move($path , $fileName);// le damos la orden al archivo que se guarde en la ruta /images/products con el filename
        $moved=$file->move($path,$fileName);//esta linea se implementa para saber si el archivo se movio 


        //crear 1 registro en la tabla product_images
        //si el archivo se ha movido se realiza su creacion de nuevo registro
        //y se lo guarda 

        if($moved){

            $productImage = new ProductImage();
            $productImage->image = $fileName; // nombre del archivo 
            //$productImage-> featured= $fileName;//
            $productImage->product_id = $id;// id del producto seleccionado para el que estamos subiedno una imagen

            $productImage->save();

            return back();


        }

        
        //return view ('admin.products.images.index')->with(compact('product','images'));



        
    }
    public function destroy(Request $request,$id){

        //eliminar el archivo 
        $productImage = ProductImage::find($request->image_id);//obtengo el id en particular de la imagen a borrar del input que esta en el index
        //si imagen comienza con http no se va a eliminar nada solo tenemos que eliminar los archivos que esten de forma local

        if(substr($productImage->image, 0 ,4) === "http"){
            
            $deleted=true;

        }else {
            $fullPath=public_path() . '/images/products/'.$productImage->image;
            $deleted=File::delete($fullPath);
        }
        
        if($deleted){
            $productImage->delete();

        }
        return back();
    }

    public function select($id , $image)
    {
        //aqui sacamos la imagen como imagen destacada ponemos su valor de featured en false
        //y luego mediante la ruta de tipo get en el botton de favorito asignamos la nueva imagen como destacada
        ProductImage::where('product_id', $id)->update([
            'featured'=> false
        ]);


        $productImage = ProductImage::find($image);
        $productImage->featured =true;
        $productImage->save();

        return back();


    }
}
