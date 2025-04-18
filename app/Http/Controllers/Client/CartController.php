<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display the shopping cart.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }

        $cart = $this->cart->getCart();
        return view('cart.index', [
            'products' => $cart['products'],
            'total' => $cart['total']
        ]);
    }

    /**
     * Add a product to the cart.
     */
    public function add(Product $product, Request $request)
    {
        if (!auth()->check()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please login to add items to cart.'
                ], 401);
            }
            return redirect()->route('login')
                ->with('error', 'Please login to add items to cart.')
                ->with('intended_url', url()->previous());
        }

        $quantity = $request->input('quantity', 1);
        $this->cart->add($product, $quantity);
        
        $cart = $this->cart->getCart();
        $count = 0;
        foreach ($cart['products'] as $item) {
            $count += $item['quantity'];
        }
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cartCount' => $count
            ]);
        }
        
        return redirect()->back()
            ->with('success', 'Product added to cart successfully!');
    }

    /**
     * Remove a product from the cart.
     */
    public function remove(Product $product)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to manage your cart.')
                ->with('intended_url', url()->previous());
        }

        $this->cart->remove($product);
        
        return redirect()->route('cart.index')
            ->with('success', 'Product removed from cart successfully!');
    }

    /**
     * Update the quantity of a product in the cart.
     */
    public function update(Product $product, Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to manage your cart.')
                ->with('intended_url', url()->previous());
        }

        $quantity = $request->input('quantity', 1);
        $this->cart->update($product, $quantity);
        
        return redirect()->route('cart.index')
            ->with('success', 'Cart updated successfully!');
    }
} 