<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SeachController extends Controller
{
    public function show(Request $request)
    {
        //recibimos la variable que traemos de nuestro buscador el query
        // luego realizamos la busqueda con la sentencia sql $products = Product::where('name', 'like',"%query%") que con esto decimos que si la palabra buscada forma parte del query arroja resultados
        $query=$request->input('query');



        $products = Product::where('name', 'like',"%$query%")->paginate(5);

        // aqui con este if decimos que si el resultado de la busqueda es exactamente un producto me lo redireciona a la pagina de ese producto
        if ($products->count()== 1) {
            $id= $products->first()->id;

            return redirect("products/$id");// es igual a 'products/'.$id
        }
           
           return view('search.show')->with(compact('products','query'));

    }
    public function data()
    {
        $products = Product::pluck('name');
       return $products;
    }
}
