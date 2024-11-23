<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    // List newsletters
    public function index()
    {
        $newsletters = Newsletter::latest()->get();
        return response()->json($newsletters);
    }

    // Create a new newsletter
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newsletter = Newsletter::create($request->all());

        return response()->json($newsletter, 201);
    }

    // Show details of a single newsletter
    public function show(Newsletter $newsletter)
    {
        return response()->json($newsletter);
    }

    // Update a newsletter
    public function update(Request $request, Newsletter $newsletter)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $newsletter->update($request->all());

        return response()->json($newsletter);
    }

    // Delete a newsletter
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();

        return response()->json(['message' => 'Newsletter deleted successfully']);
    }
}
