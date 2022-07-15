<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function show($orderId)
    {
        return response()->json(
            [
                'code' => 200,
                'message' => "OK",
                'data' => [
                    "id" => "f81d4fae-7dec-11d0-a765-00a0c91e6bf6,",
                    "status" => "open",
                    "total"=> 525,
                    "items" => [
                      [
                        "product_id" => 1,
                        "quantity"=> 1,
                        "current_price"=> 75,
                        "currency_iso"=> "USD"
                      ],
                      [
                        "product_id"=>628,
                        "quantity"=> 2,
                        "current_price"=> 450,
                        "currency_iso"=> "USD"
                      ]
                    ]
                ]
            ]
        );
    }

    public function update($orderId)
    {
        return response()->json(
            [
                "code"=> "200",
                "message"=> "Item was added to order f81d4fae-7dec-11d0-a765-00a0c91e6bf6",
                "data"=> [
                    [
                        "product_id"=> 1,
                        "quantity"=> 1,
                        "current_price"=> 750
                    ]
                ]                
            ]            
        );
    }

    public function delete($orderId, $productId)
    {
        return response()->json(
            [
                "code"=> "200",
                "message"=> "Item was removed from order f81d4fae-7dec-11d0-a765-00a0c91e6bf6",
                "data"=> [
                    [
                        "product_id"=> 1,
                        "quantity"=> 1,
                        "current_price"=> 750
                    ]
                ]                
            ]            
        );
    }    

    public function store()
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
