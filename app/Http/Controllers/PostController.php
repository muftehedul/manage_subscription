<?php

namespace App\Http\Controllers;

use App\Mail\NewPostMail;
use Illuminate\Support\Facades\Validator;


use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'website_id' => 'required|exists:websites,id',
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $post = Post::create($validated);

            $website = Website::find($validated['website_id']);
            foreach ($website->subscribers as $subscriber) {
                Mail::to($subscriber->email)->queue(new NewPostMail($post));
            }

            return response()->json($post, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
