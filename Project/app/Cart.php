<?php

namespace App;



class Cart 
{

    public $items = [];
    public $totalQty ;
    public $totalPrice;

    public function __Construct($cart = null) {
        if($cart) {
            
            $this->items = $cart->items;
            $this->totalQty = $cart->totalQty;
            $this->totalPrice = $cart->totalPrice;
        } else {
            
            $this->items = [];
            $this->totalQty = 0;
            $this->totalPrice = 0;
        }
    }

    public function AddToCart($Product) {
        $item = [
            'id' =>  $Product->id,
            'Name' => $Product->Name,
            'Price' => $Product->Price,
            'Quantity' => 0,
            'Details' => $Product->Details,
            'CategoryId' => $Product->CategoryId,
            'Picture' => $Product->Picture,
        ];

        if( !array_key_exists($Product->id, $this->items)) {
            $this->items[$Product->id] = $item ;
            $this->totalQty +=1;
            $this->totalPrice += $Product->Price; 
            
        } else {
            
            $this->totalQty +=1 ;
            $this->totalPrice += $Product->Price; 
        }
        
        $this->items[$Product->id]['Quantity']  += 1 ;
        
    }

    public function remove($id) {

        if( array_key_exists($id, $this->items)) {
            $this->totalQty -= $this->items[$id]['Quantity'];
            $this->totalPrice -= $this->items[$id]['Quantity'] * $this->items[$id]['Price'];
            unset($this->items[$id]);
        }

    }

    
    public function Quantity($id, $Quantity) {
        
        $this->totalQty -= $this->items[$id]['Quantity'] ;
        $this->totalPrice -= $this->items[$id]['Price'] * $this->items[$id]['Quantity']   ;
        $this->items[$id]['Quantity'] = $Quantity;
        $this->totalQty += $Quantity ;
        $this->totalPrice += $this->items[$id]['Price'] * $Quantity   ;

    }

}
