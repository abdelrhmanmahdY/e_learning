<?php
namespace App\Http\Controllers;

use App\Models\Borrows;
use App\Models\Book;
<<<<<<< Updated upstream
=======
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;  // Ensure this is at the top
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;  // Ensure this is present


>>>>>>> Stashed changes

class BrowseController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
<<<<<<< Updated upstream
=======
        if (!Auth::check()) {
            return redirect()->route('login');
        }

>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
=======
        // Make sure the Gate is used correctly
        Gate::authorize('isAdmin');  // Alternatively, you can use Gate::authorize directly
>>>>>>> Stashed changes

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
        $borrow->due_date = date('Y-m-d', strtotime($request->borrow_date . ' +7 days'));
        $borrow->save();

        \Log::info('Borrow record saved: ' . $borrow->id);

        // Update book availability
        $book->availability = false;
        $book->save();

        return redirect()->route('browse.index')->with('success', 'Book borrowed successfully!');
    }
}
