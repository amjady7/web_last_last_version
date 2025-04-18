<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = \App\Models\Banner::where('is_active', true)
            ->orderBy('order')
            ->get();

        $categories = \App\Models\Category::where('is_active', true)
            ->orderBy('order')
            ->limit(3)
            ->get();

        $featuredProducts = \App\Models\Product::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $hotProducts = \App\Models\Product::where('is_active', true)
            ->where('is_hot', true)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $latestProducts = \App\Models\Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact(
            'banners',
            'categories',
            'featuredProducts',
            'hotProducts',
            'latestProducts'
        ));
    }
} 