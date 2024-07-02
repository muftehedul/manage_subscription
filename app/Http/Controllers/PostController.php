<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;


use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate(['website_id' => 'required|exists:websites,id', 'title' => 'required|string|max:255', 'description' => 'required|string',]);
            $post = Post::create($validated);

            return response()->json($post, 201);
        } catch (ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
