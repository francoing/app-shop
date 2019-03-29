<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories=Category::orderBy('name')->paginate(10);

        return view('admin.categories.index')->with(compact('categories'));//listado

    }


    public function create()
    {
        return view('admin.categories.create');//formulario de registro
    }


    public function store(Request $request)
    {
        
        //mensajes personalizados cuando no se cumpla una condicion
        
        $this->validate($request,Category::$rules,Category::$messages);


        //registrar la categoria en la BD

        //dd($request->all());
        /*
        $categories= new Category();
        $categories->name= $request-> input('name');
        $categories->description= $request-> input('description');
        $categories->save();*/


        //de esta manera lo hacemos de forma mas abreviada pasamos los campos que querramos que nuestra categoria tenga

        //Category::create($request->all());// se llama mass assignment asignacion masiva tenemos que ir a nuestro modelo y declarar que atributos va a tener nuestra categoria

        $category=Category::create($request->only('name','description'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path =public_path() . '/images/categories';
            $fileName = uniqid().'-'. $file->getClientOriginalName();
            $moved=$file->move($path,$fileName);

            if ($moved) {
                $category->image=$fileName;
                $category->save();
             }

        }

        return redirect('/admin/categories');
        

  
    }

    public function edit(Category $category)
    {
        //return "Mostrar aqui el form de edicion para el producto con id $id";
        return view('admin.categories.edit')->with(compact('category'));//formulario de registro
    }


    public function update(Request $request,Category $category)
    {

        
        $this->validate($request,Category::$rules,Category::$messages);



        //registrar el nuevo producto en la BD

        //dd($request->all());
       $category->update($request->only('name','description'));

       if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path =public_path() . '/images/categories';
            $fileName = uniqid().'-'. $file->getClientOriginalName();
            $moved=$file->move($path,$fileName);

            if ($moved) {

                $previousPath= $path . '/'.$category->image;

                $category->image=$fileName;
                $saved=$category->save();//update

                if ($saved) {
                    File::delete($previousPath);
                }
        
            }
        }

        return redirect('/admin/categories');
        
    }


    public function destroy(Category $category)
    {
        //Category::where('category_id', $id)->delete();
        //$category= Category::find($id);
        $category->delete();

        return back();
    }

    


}
