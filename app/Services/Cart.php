<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class Cart
{
    /**
     * Get the cart contents.
     */
    public static function get()
    {
        return Session::get('cart', []);
    }

    /**
     * Get the total number of items in the cart.
     */
    public static function count()
    {
        $cart = Session::get('cart', ['products' => [], 'total' => 0]);
        $count = 0;
        foreach ($cart['products'] as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }

    /**
     * Add a product to the cart.
     */
    public static function add(Product $product, int $quantity = 1)
    {
        $cart = Session::get('cart', ['products' => [], 'total' => 0]);
        
        // Check if product already exists in cart
        $existingIndex = false;
        foreach ($cart['products'] as $index => $item) {
            if ($item['product']->id === $product->id) {
                $existingIndex = $index;
                break;
            }
        }
        
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

        // Update total
        $total = 0;
        foreach ($cart['products'] as $item) {
            $total += $item['product']->price * $item['quantity'];
        }
        $cart['total'] = $total;

        Session::put('cart', $cart);
    }

    /**
     * Remove a product from the cart.
     */
    public static function remove(Product $product)
    {
        $cart = self::get();
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            Session::put('cart', $cart);
        }
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public static function update(Product $product, int $quantity)
    {
        $cart = self::get();
        if ($quantity > 0) {
            $cart[$product->id] = $quantity;
        } else {
            unset($cart[$product->id]);
        }
        Session::put('cart', $cart);
    }

    /**
     * Clear the cart.
     */
    public static function clear()
    {
        Session::forget('cart');
    }

    /**
     * Get the total price of items in the cart.
     */
    public static function total()
    {
        $cart = self::get();
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->price * $quantity;
            }
        }

        return $total;
    }
} 