<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $loans = Loan::where('book_id', $book->id)->orWhere('user_id', Auth::user()->id)->first();
        $reviews = $book->review;
        return view('books.show', compact('book', 'loans', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'realese_year' => 'required',
        ]);

        $book->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
    }
}
