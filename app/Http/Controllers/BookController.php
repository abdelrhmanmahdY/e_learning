<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Retrieve all books
        return view('book.index', compact('books'));
    }

    // public function create()
    // {
    //     return view('book.create'); // Show form to create a new book
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'author' => 'required|string|max:255',
    //         'category' => 'required|string|max:255',
    //         'availability' => 'required|boolean',
    //     ]);

    //     Book::create($request->all()); // Create a new book record

    //     return redirect()->route('book.index'); // Redirect to the book index
    // }
}
