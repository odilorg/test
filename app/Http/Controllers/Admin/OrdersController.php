<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderPixel;
use App\Models\User;
use App\Models\payment;


class OrdersController extends Controller
{
    public function getListOrders() {
        $user = new User;
        $OrderPixel = new OrderPixel;

        $getAllUsers = User::all();
        $getAllOrders = OrderPixel::all();
        $getAllPayment = payment::all();

        return response()->view('admin/orders', ['Users' => $getAllUsers,'Orders' => $getAllOrders, 'Payment' => $getAllPayment]);
        
    }
}
