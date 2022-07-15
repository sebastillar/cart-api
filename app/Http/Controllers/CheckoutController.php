<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function store($orderId)
    {
        return response()->json(
            [
                "code"=> 200,
                "message"=> "Order was successfully added.",
                "data"=> [
                    
                    "id"=> "f81d4fae-7dec-11d0-a765-00a0c91e6bf6",
                    "status"=> "open",
                    "items"=> [
                    [
                      "id"=> 1,
                      "quantity"=> 2,
                      "product_id"=> "325ASSS758",
                      "status"=> "active"
                    ],
                    [
                      "id"=> 1,
                      "quantity"=> 2,
                      "product_id"=> "325ASSS758",
                      "status"=> "active"
                    ]
                  ],
                  "subtotal_amount"=> 528,
                  "customer_id"=> 2147483647,
                  "shipment"=> [] ,
                  "billing"=> [],
                  "payment"=> [] 
                ]
            ]          
        );
    }

}
