<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_title' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
        ]);

        $settings = Setting::first() ?? new Setting();

        if ($request->hasFile('site_logo')) {
            // Delete old logo if exists
            if ($settings->site_logo) {
                Storage::delete('public/' . $settings->site_logo);
            }
            
            $logoPath = $request->file('site_logo')->store('logos', 'public');
            $settings->site_logo = $logoPath;
        }

        $settings->site_title = $request->site_title;
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->facebook_url = $request->facebook_url;
        $settings->twitter_url = $request->twitter_url;
        $settings->instagram_url = $request->instagram_url;
        $settings->linkedin_url = $request->linkedin_url;
        $settings->youtube_url = $request->youtube_url;

        $settings->save();

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }
} 