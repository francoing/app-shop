<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Mail\NewOrder;
use Mail;


class CartController extends Controller
{
    public function update()
    {
        //crearemos una variable client que es el que hace el pedido
        $client = auth()->user();
        $cart=$client->cart;
        $cart->status='Pending';
        $cart->order_date= Carbon::now();
        $cart -> save();

        $admins= User::where('admin', true)->get();
        Mail::to($admins)->send(new NewOrder($client,$cart));

        $notification= 'Tu pedido ah sido registrado correctamente te contactaremos via mail!.';

        
        
        return back()->with(compact('notification'));



    }
}
