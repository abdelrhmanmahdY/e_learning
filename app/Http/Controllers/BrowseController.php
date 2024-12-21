<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

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
}
