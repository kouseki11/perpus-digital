<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Models\Book;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        return view('admin.books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'author' => 'required',
                'publisher' => 'required',
                'release_date' => 'required',
                'synopsis' => 'required|max:1317',
                'cover' => 'required|max:5048',
            ]);

            $image = $request->file('cover');

            if ($image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('cover_images'), $imageName);
                $imagePost = $imageName;
            }

            $imagePost = 'cover_images/' . $imagePost;

            Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'release_date' => $request->release_date,
                'synopsis' => $request->synopsis,
                'cover' => $imagePost
            ]);

            return redirect()->route('books.index')->with('success', 'Book created successfully.');
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function export()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }
}
