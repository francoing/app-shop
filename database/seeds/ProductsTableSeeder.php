<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
      /*esta es una manera de poblar las tablas 
       factory(Category::class ,5)->create();
       factory(Product::class ,100)->create();
       factory(ProductImage::class ,200)->create();*/

       /*esta es otra manera mediante relaciones crea 5 categorias
       pone 20 productos por categoria y 5 imagenes por producto*/
       $categories =factory(Category::class , 4)->create ();
       $categories ->each (function ($category){

        $products= factory(Product::class,5)->make();
        $category-> products()->saveMany($products);

        $products->each(function ($p){
            $images= factory (ProductImage::class , 3)->make();
            $p->images()->saveMany($images);


            });

       });

       

      /* este es un ejemplo de la documentacion de laravel
       factory(App\User::class, 50)
       ->create()
       ->each(function ($u) {
        $u->posts()->save(factory(App\Post::class)->make());
        
    });*/




    }
}
