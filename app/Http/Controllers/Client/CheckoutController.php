<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CartService;

class CheckoutController extends Controller
{
    protected $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        // Check if user is admin
        if (auth()->user()->is_admin) {
            return redirect()->route('cart.index')->with('error', 'You are an admin! You cannot buy from your own shop - you own it! 😊');
        }

        $cart = $this->cart->getCart();
        
        if (empty($cart['products'])) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.index', [
            'products' => $cart['products'],
            'total' => $cart['total']
        ]);
    }

    public function store(Request $request)
    {
        // Check if user is admin
        if (auth()->user()->is_admin) {
            return redirect()->route('cart.index')->with('error', 'You are an admin! You cannot buy from your own shop - you own it! 😊');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
        ]);

        // Get cart data
        $cart = $this->cart->getCart();
        
        if (empty($cart['products'])) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Format shipping address as a string
        $shippingAddress = implode(', ', [
            $request->name,
            $request->address,
            $request->city,
            $request->state,
            $request->zip_code,
            $request->country
        ]);

        // Create order
        $order = auth()->user()->orders()->create([
            'total_amount' => $cart['total'],
            'status' => 'pending',
            'payment_status' => 'pending',
            'shipping_address' => $shippingAddress,
            'billing_address' => $shippingAddress,
        ]);

        // Add order items
        foreach ($cart['products'] as $item) {
            $order->items()->create([
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'price' => $item['product']->price,
                'total' => $item['product']->price * $item['quantity']
            ]);
        }

        // Clear the cart
        $this->cart->clear();

        return redirect()->route('client.orders.show', $order)
            ->with('success', 'Your order has been placed successfully!');
    }
} 