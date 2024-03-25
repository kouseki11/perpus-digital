<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {

        $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);

        $book_id = $book->id;
        $user_id = Auth::user()->id;

        Review::create([
            'book_id' => $book_id,
            'user_id' => $user_id,
            'review' => $request->review,
            'rating' => $request->rating
        ]);

        return redirect()->back()->with('success', 'Review created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);

        $review->update($request->all());

        return redirect()->back()->with('success', 'Review created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
