<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class TestController extends Controller
{

   public function welcome()
   {

//con has solo obtenemos las categorias que tienen productos en ella nos facilita y no hace falta que realicemos un join
       $categories= Category::has('products')->get();
       return view('welcome')->with(compact('categories'));
   }
}
