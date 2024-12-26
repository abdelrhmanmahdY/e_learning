<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all(); // Retrieve all books

        return view('book.index', compact('books'));
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'availability' => 'required|boolean',
            'pdf_url' => 'nullable|file|mimes:pdf|max:10240',
            'purchase_price' => 'nullable|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $book = new Book();
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->category = $validatedData['category'];
        $book->availability = $validatedData['availability'];
        $book->purchase_price = $validatedData['purchase_price'];
        if ($request->hasFile('pdf_url')) {
            $file = $request->pdf_url;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $request->pdf_url->move('assets', $fileName);


            $book->pdf_url = $fileName;
        }
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $imageData = file_get_contents($file);
            $book->photo = $imageData;
        }
        $book->save();

        return redirect()->route('book.index')->with('success', 'Book added successfully!');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'availability' => 'required|boolean',
            'pdf_url' => 'nullable|file|mimes:pdf|max:10240',
            'purchase_price' => 'nullable|numeric|min:0',
        ]);

        $book = Book::findOrFail($id);
        $book->title = $validatedData['title'];
        $book->author = $validatedData['author'];
        $book->category = $validatedData['category'];
        $book->availability = $validatedData['availability'];
        $book->purchase_price = $validatedData['purchase_price'];



        $book->save();

        return redirect()->route('book.index')->with('success', 'Book updated successfully!');
    }
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully!');
    }
}
