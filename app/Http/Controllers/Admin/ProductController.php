<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use App\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products=Product::paginate(10);

        return view('admin.products.index')->with(compact('products'));//listado

    }


    public function create()
    {
        $categories=Category::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories'));;//formulario de registro
    }


    public function store(Request $request)
    {
        
        //mensajes personalizados cuando no se cumpla una condicion
        $messages =[
            'name.required'=>'Es necesario ingresar el nombre para el producto.',
            'name.min'=>'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required'=>'La descripcion de este producto es un campo requerido.',
            'description.max'=>'La descripcion de este producto no puede tener mas de 200 caracteres.',
            'price.required'=>'El precio de este producto es una campo requerido.',
            'price.numeric'=>'El precio de este producto no es valido.',
            'price.min'=>'No se admiten valores negativos.'




        ];
        
        //validacion de los datos en el formulario de creacion de un producto
        $rules =[
            'name'=>'required|min:3',
            'description'=>'required|max:200',
            'price'=>'required|numeric|min:0'


        ];
        $this->validate($request,$rules,$messages);


        //registrar el nuevo producto en la BD

        //dd($request->all());
        $product= new Product();
        $product->name= $request-> input('name');
        $product->description= $request-> input('description');
        $product->price= $request-> input('price');
        $product->long_description= $request-> input('long_description');

        // aqui utilizamos una pequeña logica para darle el id null a la category_id por que nos genera problemas en nuestra base de datos
        if ($request->category_id == 0) {
           return $product->category_id= null;
        }else {
            $product->category_id= $request->category_id;
        }
        $product->save();

        return redirect('/admin/products');
        

  
    }

    public function edit($id)
    {
        //return "Mostrar aqui el form de edicion para el producto con id $id";
        $categories=Category::orderBy('name')->get();
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product','categories'));//formulario de registro
    }


    public function update(Request $request,$id)
    {

        $messages =[
            'name.required'=>'Es necesario ingresar el nombre para el producto.',
            'name.min'=>'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required'=>'La descripcion de este producto es un campo requerido.',
            'description.max'=>'La descripcion de este producto no puede tener mas de 200 caracteres.',
            'price.required'=>'El precio de este producto es una campo requerido.',
            'price.numeric'=>'El precio de este producto no es valido.',
            'price.min'=>'No se admiten valores negativos.'




        ];
        
        //validacion de los datos en el formulario de creacion de un producto
        $rules =[
            'name'=>'required|min:3',
            'description'=>'required|max:200',
            'price'=>'required|numeric|min:0'
        ];
        $this->validate($request,$rules,$messages);



        //registrar el nuevo producto en la BD

        //dd($request->all());
        $product= Product::find($id);
        $product->name= $request-> input('name');
        $product->description= $request-> input('description');
        $product->price= $request-> input('price');
        $product->long_description= $request-> input('long_description');
        $product->category_id= $request->category_id;
        $product->save();// update

        return redirect('/admin/products');
        
    }


    public function destroy($id)
    {
        ProductImage::where('product_id', $id)->delete();
        $product = Product::find($id);
        $product->delete();

        return back();
    }



}
