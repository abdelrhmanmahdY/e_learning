<?php

namespace App\Http\Controllers;
use App\Models\Borrows;
use Illuminate\Http\Request;
use App\Models\Book;

class BrowseController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $books = Book::where('title', 'like', '%' . $search . '%')
                ->orWhere('author', 'like', '%' . $search . '%')
                ->orWhere('category', 'like', '%' . $search . '%')
                ->get();
        } else {
            $books = Book::all();
        }

        return view('browse.index', compact('books'));
    }
    
    public function show(Request $request)
    {
        $book = Book::findOrFail($request->id);


        return view('browse.show', compact('book'));
    }
    public function store(Request $request)
    {
        \Log::info('Request data: ', $request->all());

        $validatedData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
            'borrow_date' => 'required|date|after_or_equal:today',
        ]);
    
        \Log::info('Validated data: ', $validatedData);
    
        $userId = decrypt($validatedData['user_id']);
        $bookId = decrypt($validatedData['book_id']);
    
        \Log::info('Decrypted user_id: ' . $userId);
        \Log::info('Decrypted book_id: ' . $bookId);
    
        $book = Book::findOrFail($bookId);
        if (!$book->availability) {
            return back()->withErrors(['book_id' => 'This book is currently unavailable for borrowing.']);
        }
    
        // Create the borrow record
        $borrow = new Borrows();
        $borrow->user_id = $userId;
        $borrow->book_id = $bookId;
        $borrow->borrow_date = $request->borrow_date;
        $borrow->due_date = date('Y-m-d', strtotime($request->borrow_date . ' +7 days')); // Example due date logic
        $borrow->save();
    
        \Log::info('Borrow record saved: ' . $borrow->id);
    
        // Update book availability
        $book->availability = false;
        $book->save();
    
        return redirect()->route('browse.index')->with('success', 'Book borrowed successfully!');
    }
    // public function destroy(Request $request, $id)
    // {    $borrow->user()->detach();
    //     $borrow->book()->detach();
    //     $borrow->delete();
    //     return redirect()->route('borrows.index')->with('success', 'Borrow deleted successfully');
    // }


    // public function update(Request $request, $id)
    // {
       
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'book_id' => 'required|exists:books,id',
    //         'borrow_date' => 'required|date',
    //         'due_date' => 'required|date',
    //     ]);

    //     $borrow = new Borrow();
    //     $borrow->user_id = $request->user_id;
    //     $borrow->book_id = $request->book_id;
    //     $borrow->borrow_date = $request->borrow_date;
    //     $borrow->due_date = $request->due_date;
   
    //     $borrow->save();
    //     $borrow->user()->attach($request->user_id);
    //     $borrow->book()->attach($borrow->book_id );
    //     return redirect()->route('borrows.index')->with('success', 'Borrow updated successfully');
    // }
}
