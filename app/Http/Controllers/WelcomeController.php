<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;

class WelcomeController extends Controller
{
    /**
     * Show the welcome page.
     */
    public function index()
    {
        $banners = Banner::all();
        $categories = Category::all();
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->take(8)
            ->get();
        $hotProducts = Product::where('is_active', true)
            ->where('is_hot', true)
            ->latest()
            ->take(8)
            ->get();
        $latestProducts = Product::where('is_active', true)
            ->latest()
            ->take(8)
            ->get();
        
        return view('home', compact('banners', 'categories', 'featuredProducts', 'hotProducts', 'latestProducts'));
    }

    /**
     * Redirect to the appropriate dashboard based on user role.
     */
    public function redirectToDashboard()
    {
        if (auth()->check()) {
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('client.dashboard');
        }
        
        return redirect()->route('login');
    }
} 