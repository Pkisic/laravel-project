<?php

namespace App\Shop;

use App\Models\Product;

/**
 * Description of ShoppingCart
 *
 * @author Predrag
 */
class ShoppingCart {
    
    /**
     *
     * @var ShoppingCartItem[]
     */
    protected $items = [];
    
    /**
     * Singleton pattern, returns from session
     * @return \App\Shop\ShoppingCart
     */
    public static function getShoppingCartFromSession(){
        $shoppingCart = session()->get('shoppingCart');
        if(!($shoppingCart instanceof ShoppingCart)){
            $shoppingCart = new ShoppingCart();
            session()->put('shoppingCart',$shoppingCart);
        }
        return $shoppingCart;
    }
    
    public function addProduct(Product $product, $quantity){
        
        foreach($this->items as $item){
            if($item->getProduct()->id == $product->id){
                $item->increaseQuantity($quantity);
                return $this;
            }
        }
        $newProduct = new ShoppingCartItem($product,$quantity);
        $this->items[] = $newProduct;
        return $this;
    }
    
    public function changeQuantity(Product $product, $quantity){
        
        foreach($this->items as $item){
            if($item->getProduct()->id == $product->id){
                $item->setQuantity($quantity);
                return $this;
            }
        }
        return $this;
        
    }
    
    public function removeProduct($productId){
        foreach($this->items as $key => $item){
            if($item->getProduct()->id == $productId){
                unset($this->items[$key]);
                return $this;
            }
        }
        return $this;
    }
    
    public function itemsCount(){
        return count($this->items);
    }
    
    public function getItems(){
        return $this->items;
    }
    
    public function getTotal(){
        
        $total = 0;
        
        foreach($this->items as $item){
            $total += $item->getSubTotal();
        }
        
        return $total;
    }
    /**
     * Checks for items currently in Shopping Cart
     * if they are still present in the database
     * 
     * @return $this Fluent Interface
     */
    public function checkDatabase(){
        
        if(!empty($this->getItems())){
            foreach($this->getItems() as $product){
                if(!(Product::find($product->getProduct()->id))){
                    $this->removeProduct($product->getProduct()->id);
                }
            }
        }
        return $this;
    }
    
    public function emptyCart(){
        $this->items = [];
        
        return $this;
    }
}
