<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use Illuminate\Validation\ValidationException;

class WebsiteController extends Controller
{
    public function index()
    {
        $websites = Website::all();
        return response()->json($websites, 200);
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'url' => 'required|string|url|unique:websites,url',
            ]);
            $website = Website::create($validated);

            return response()->json($website, 201);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
