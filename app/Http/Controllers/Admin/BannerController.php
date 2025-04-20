<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        Log::info('Banners retrieved:', ['count' => $banners->count(), 'banners' => $banners->toArray()]);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Log the incoming request data
            \Log::info('Incoming request data:', $request->all());

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'link' => 'nullable|url',
                'is_active' => 'nullable',
                'order' => 'nullable|integer'
            ]);

            \Log::info('Validated data:', $validatedData);

            // Handle file upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('banners', $imageName, 'public');
                
                \Log::info('Image uploaded:', ['path' => $imagePath]);
                
                if (!$imagePath) {
                    throw new \Exception('Failed to store the image');
                }
            } else {
                throw new \Exception('No image file was uploaded');
            }

            // Generate unique slug
            $slug = $this->generateUniqueSlug($validatedData['title']);
            \Log::info('Generated slug:', ['slug' => $slug]);

            // Convert checkbox value to boolean
            $isActive = $request->has('is_active') ? true : false;

            // Prepare banner data
            $bannerData = [
                'title' => $validatedData['title'],
                'description' => $validatedData['description'] ?? null,
                'image' => $imagePath,
                'link' => $validatedData['link'] ?? null,
                'is_active' => $isActive,
                'order' => $validatedData['order'] ?? 0,
                'slug' => $slug
            ];

            \Log::info('Attempting to create banner with data:', $bannerData);

            // Create the banner
            $banner = Banner::create($bannerData);

            if (!$banner) {
                throw new \Exception('Failed to create banner');
            }

            \Log::info('Banner created successfully:', ['banner' => $banner->toArray()]);

            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error creating banner:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // If there's an error, delete the uploaded image if it exists
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            return back()
                ->withInput()
                ->with('error', 'Error creating banner: ' . $e->getMessage());
        }
    }
    

    /**
     * Generate a unique slug for the banner.
     *
     * @param  string  $title
     * @return string
     */
    private function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $count = Banner::where('slug', $slug)->count();

        if ($count > 0) {
            $slug = $slug . '-' . date('ymdis') . '-' . rand(0, 999);
        }

        return $slug;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'link' => 'nullable|url',
                'is_active' => 'nullable|boolean',
                'order' => 'nullable|integer',
            ]);

            // Handle file upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                    Storage::disk('public')->delete($banner->image);
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('banners', $imageName, 'public');
                $validatedData['image'] = $imagePath;
            }

            // Convert checkbox value to boolean
            $validatedData['is_active'] = $request->has('is_active');

            // Update the banner
            $banner->update($validatedData);

            return redirect()->route('admin.banners.index')
                ->with('success', 'Banner updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error updating banner:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('error', 'Error updating banner: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Delete the banner image from storage
        Storage::disk('public')->delete($banner->image);

        // Delete the banner from the database
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner deleted successfully.');
    }
}
