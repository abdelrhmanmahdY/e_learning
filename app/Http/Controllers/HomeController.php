<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrows;
use App\Models\User;
use App\Models\Purchase;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        // Get the search query
        $search = $request->input('query', null);

        // Get the top 3 most borrowed books
        $mostBorrowedBooks = Book::select('books.id', 'books.title', 'books.author', 'books.category', 'books.availability', 'books.pdf_url', 'books.purchase_price')
            ->join('borrows', 'books.id', '=', 'borrows.book_id')
            ->selectRaw('count(borrows.id) as borrow_count')
            ->groupBy('books.id', 'books.title', 'books.author', 'books.category', 'books.availability', 'books.pdf_url', 'books.purchase_price')
            ->orderByDesc('borrow_count');
        //         if ($search==null)
        // {dd($search);}
        if ($search) {
            $mostBorrowedBooks->where(function ($query) use ($search) {
                $query->where('books.title', 'LIKE', "%{$search}%")
                    ->orWhere('books.author', 'LIKE', "%{$search}%")
                    ->orWhere('books.category', 'LIKE', "%{$search}%");
            });
        }

        $mostBorrowedBooks = $mostBorrowedBooks->take(3)->get();

        // Get the top 3 most purchased books
        $mostPurchasedBooks = Book::select('books.id', 'books.title', 'books.author', 'books.category', 'books.availability', 'books.pdf_url', 'books.purchase_price')
            ->join('purchases', 'books.id', '=', 'purchases.book_id')
            ->selectRaw('count(purchases.id) as purchase_count')
            ->groupBy('books.id', 'books.title', 'books.author', 'books.category', 'books.availability', 'books.pdf_url', 'books.purchase_price')
            ->orderByDesc('purchase_count');

        if ($search) {
            $mostPurchasedBooks->where(function ($query) use ($search) {
                $query->where('books.title', 'LIKE', "%{$search}%")
                    ->orWhere('books.author', 'LIKE', "%{$search}%")
                    ->orWhere('books.category', 'LIKE', "%{$search}%");
            });
        }

        $mostPurchasedBooks = $mostPurchasedBooks->take(3)->get();

        // Get the 3 newest books
        $newestBooks = Book::orderByDesc('created_at')
            ->take(3);

        if ($search) {
            $newestBooks->where(function ($query) use ($search) {
                $query->where('books.title', 'LIKE', "%{$search}%")
                    ->orWhere('books.author', 'LIKE', "%{$search}%")
                    ->orWhere('books.category', 'LIKE', "%{$search}%");
            });
        }

        $newestBooks = $newestBooks->get();

        return view('welcome', compact('mostBorrowedBooks', 'mostPurchasedBooks', 'newestBooks', 'search'));
    }
    
}
