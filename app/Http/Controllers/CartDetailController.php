<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

class CartDetailController extends Controller
{
    public function store(Request $request){


        $cartDetail= new CartDetail();
        $cartDetail->cart_id = auth()->user()->cart->id ;
        $cartDetail->product_id=$request->product_id;
        $cartDetail->quantity = $request->quantity;
        $cartDetail->save();

        $notification='El producto se a agregado de forma exitosa a tu carrito de compra.';
        return back()->with(compact('notification'));

    }
    public function destroy(Request $request){


        $cartDetail= CartDetail::find($request->cart_detail_id);
        // vamos a cubrir una vulnerabilidad y vamos a preguntar si este id de cartdetail pertence a un usuario activo
        if ($cartDetail->cart_id == auth()->user()->cart->id) {
            $cartDetail->delete();
        }
        
        $notification='El Producto se a eliminado de forma exitosa.';

        return back()->with(compact('notification'));

    }
}
