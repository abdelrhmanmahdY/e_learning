<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrows;
use App\Models\User;
use App\Models\Purchase;


class HomeController extends Controller
{
    public function index()
    {
        // Get the top 3 most borrowed books
        $mostBorrowedBooks = Book::select('books.id', 'books.title', 'books.author', 'books.category', 'books.availability', 'books.pdf_url', 'books.purchase_price')
            ->join('borrows', 'books.id', '=', 'borrows.book_id')
            ->selectRaw('count(borrows.id) as borrow_count')
            ->groupBy('books.id', 'books.title', 'books.author', 'books.category', 'books.availability', 'books.pdf_url', 'books.purchase_price')
            ->orderByDesc('borrow_count')
            ->take(3)
            ->get();

        // Get the top 3 most purchased books
        $mostPurchasedBooks = Book::select('books.id', 'books.title', 'books.author', 'books.category', 'books.availability', 'books.pdf_url', 'books.purchase_price', 'books.photo')
            ->join('purchases', 'books.id', '=', 'purchases.book_id')
            ->selectRaw('count(purchases.book_id) as purchase_count')
            ->groupBy('books.id', 'books.title', 'books.author', 'books.category', 'books.availability', 'books.pdf_url', 'books.purchase_price', 'books.photo')
            ->orderByDesc('purchase_count')
            ->take(3)
            ->get();

        // Get the 3 newest books
        $newestBooks = Book::orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('welcome', compact('mostBorrowedBooks', 'mostPurchasedBooks', 'newestBooks'));
    }
}
