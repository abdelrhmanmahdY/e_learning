<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Retrieve all books
        return view('book.index', compact('books'));
    }



    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'availability' => 'boolean',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'purchase_price' => 'nullable|numeric',
        ]);
        if (!$request->has('availability')) {
            $request->merge(['availability' => false]);
        }

        $pdfPath = ($request->hasFile('pdf')) ? $pdfPath = $request->file('pdf')->store('pdfs', 'public') : $pdfPath = null;

        // Create the book record
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'category' => $request->category,
            'availability' => $request->availability,
            'pdf_url' => $pdfPath,
            'purchase_price' => $request->purchase_price >= 0,
        ]);

        return redirect()->route('book.index')->with('success', 'Book created successfully.');
    }
}
