<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrows;

class BrowseController extends Controller
{

    public function index()
    {
        $books = Book::all();
        return view('browse.index', compact('books'));
    }
    public function show(Request $request)
    {
        $book = Book::findOrFail($request->id);


        return view('browse.show', compact('book'));
    }
    public function store(Request $request)
    {
        if ($request->has(
            'submit'
        ) == 'purchies') {
        }
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        $borrow = new Borrows();
        $borrow->user_id = $request->user_id;
        $borrow->book_id = $request->book_id;
        $borrow->borrow_date = $request->borrow_date;
        $borrow->due_date = $request->due_date;

        $borrow->save();
        $borrow->user()->attach($request->user_id);
        $borrow->book()->attach($borrow->book_id);
        return redirect()->route('borrows.index')->with('success', 'Borrow created successfully');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        $borrow = new Borrows();
        $borrow->user_id = $request->user_id;
        $borrow->book_id = $request->book_id;
        $borrow->borrow_date = $request->borrow_date;
        $borrow->due_date = $request->due_date;

        $borrow->save();
        $borrow->user()->attach($request->user_id);
        $borrow->book()->attach($borrow->book_id);
        return redirect()->route('borrows.index')->with('success', 'Borrow updated successfully');
    }
}
