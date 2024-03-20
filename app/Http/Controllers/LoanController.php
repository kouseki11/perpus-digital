<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = Loan::all();
        return view('loans.index', compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('loans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        try {    
            $user_id = Auth::user()->id;
    
            Loan::create([
                'book_id' => $book->id,
                'user_id' => $user_id,
                'status' => 'loaned',
                'loan_date' => now()
            ]);

            return redirect()->back()->with('success', 'Book loaned successfully!');
        } catch(Exception $e){
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        return view('loans.show', compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loan $loan)
    {
        return view('loans.edit', compact('loan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Loan $loan)
    {
    
        $loan->update([
            'status' => 'returned',
            'return_date' => now()
        ]);

        return redirect()->back()->with('success', 'Book returned successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();
    }
}
