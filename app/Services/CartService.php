<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    protected const CART_KEY = 'cart';

    public function getCart()
    {
        $cart = Session::get(self::CART_KEY, ['products' => [], 'total' => 0]);
        
        // Ensure the cart has the required structure
        if (!isset($cart['products'])) {
            $cart['products'] = [];
        }
        if (!isset($cart['total'])) {
            $cart['total'] = 0;
        }

        return $cart;
    }

    public function add(Product $product, int $quantity = 1)
    {
        $cart = $this->getCart();
        
        // Check if product already exists in cart
        $existingIndex = $this->findProductIndex($cart['products'], $product->id);
        
        if ($existingIndex !== false) {
            // Update quantity if product exists
            $cart['products'][$existingIndex]['quantity'] += $quantity;
        } else {
            // Add new product to cart
            $cart['products'][] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }

        $this->updateTotal($cart);
        Session::put(self::CART_KEY, $cart);
    }

    public function remove(Product $product)
    {
        $cart = $this->getCart();
        
        $index = $this->findProductIndex($cart['products'], $product->id);
        if ($index !== false) {
            array_splice($cart['products'], $index, 1);
            $this->updateTotal($cart);
            Session::put(self::CART_KEY, $cart);
        }
    }

    public function update(Product $product, int $quantity)
    {
        if ($quantity <= 0) {
            $this->remove($product);
            return;
        }

        $cart = $this->getCart();
        
        $index = $this->findProductIndex($cart['products'], $product->id);
        if ($index !== false) {
            $cart['products'][$index]['quantity'] = $quantity;
            $this->updateTotal($cart);
            Session::put(self::CART_KEY, $cart);
        }
    }

    public function clear()
    {
        Session::forget(self::CART_KEY);
    }

    protected function findProductIndex(array $products, int $productId)
    {
        foreach ($products as $index => $item) {
            if ($item['product']->id === $productId) {
                return $index;
            }
        }
        return false;
    }

    protected function updateTotal(array &$cart)
    {
        $total = 0;
        foreach ($cart['products'] as $item) {
            $total += $item['product']->price * $item['quantity'];
        }
        $cart['total'] = $total;
    }
} 