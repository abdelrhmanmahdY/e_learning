<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Borrows;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use App\Models\Purchase;
use App\Models\Reservation;
use Illuminate\Support\Facades\Log;


class BrowseController extends Controller
{

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login page if not authenticated
        }

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
        // if (!Gate::allows('isAdmin')) {
        //     abort(404);
        // }
        $userId = auth()->id();
         $user=User::findOrFail($userId);
         if($user->hasPenalty('2')){redirect()->route('home')->with('error', 'high penalties.');}
         
        $hasPurchased = Purchase::where('user_id', $userId) 
            ->where('book_id', $book->id)
            ->exists();

     
        $hasReserved = Reservation::where('user_id', $userId)
            ->where('book_id', $book->id)
            ->where('status', 'still')
            ->exists();

       
        $isFirstReservation = Reservation::where('book_id', $book->id)
            ->where('status', 'still')
            ->orderBy('reservation_date', 'asc')
            ->first();

        $isUserFirstReservation = $isFirstReservation && $isFirstReservation->user_id === $userId;

        $isReservedDone = Reservation::where('book_id', $book->id)
            ->where('status', 'done')
            ->exists();

        $isReserved = Reservation::where('book_id', $book->id)->exists();

        $lastBorrowRecord = Borrows::where('book_id', $book->id)->latest()->first();
        $isBorrowed = $lastBorrowRecord && $lastBorrowRecord->return_at === null;

        $borrow = Borrows::where('user_id', $userId)
        ->where('book_id', $book->id)
        ->latest()
        ->first();
        $last = Borrows::where('book_id', $book->id)
        ->latest()
        ->first();

        
        $book = Book::findOrFail($book->id);
        $remainingTime = null;
        if ($borrow && $borrow->due_date && !$borrow->return_at) {
        $returnedAt = Carbon::parse($borrow->due_date);
        $now = Carbon::now();

        // Calculate the difference and ensure it's not negative
        $remainingTime = $returnedAt->diffForHumans($now, ['syntax' => Carbon::DIFF_ABSOLUTE]);
        
        }


        return view('browse.show', compact('book', 'last','remainingTime','borrow','hasPurchased', 'isUserFirstReservation', 'isReservedDone', 'isReserved', 'hasReserved', 'isBorrowed'));
    }

    public function store(Request $request)
    {
        Log::info('Request data: ', $request->all());
        
        if ($request->get('submit') == 'borrow') {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'book_id' => 'required',
                'borrow_date' => 'required|date|after_or_equal:today',
            ]);
            $userI = auth()->id();
            $use=User::findOrFail($userI);
            if($use->hasPenalty('1')){
                redirect()->route('home')->with('error', 'low penalties.');
            }
            Log::info('Validated data: ', $validatedData);

            $userId = decrypt($validatedData['user_id']);
            $bookId = decrypt($validatedData['book_id']);

            Log::info('Decrypted user_id: ' . $userId);
            Log::info('Decrypted book_id: ' . $bookId);

            $book = Book::findOrFail($bookId);
      
            if (!$book->availability) {
                return back()->withErrors(['book_id' => 'This book is currently unavailable for borrowing.']);
            }

           
            $borrow = new Borrows();
            $borrow->user_id = $userId;
            $borrow->book_id = $bookId;
            $borrow->borrow_date = $request->borrow_date;
            $borrow->due_date = date('Y-m-d', strtotime($request->borrow_date . ' +7 days')); 
            $borrow->save();

            Log::info('Borrow record saved: ' . $borrow->id);
            $book->availability = false;
            $book->save();

            return redirect()->route('browse.index')->with('success', 'Book borrowed successfully!');
        } else if ($request->get('submit') == 'returnbook') {
            $validatedData = $request->validate([
                'book_id' => 'required',
            ]);
            $userI = auth()->id();
            $use=User::findOrFail($userI);
            if($use->hasPenalty('1')){redirect()->route('home')->with('error', 'low penalties.');}
            $bookId = decrypt($validatedData['book_id']);
            $lastBorrowRecord = Borrows::where('book_id', $bookId)->latest()->first();
        
            if (!$lastBorrowRecord) {
                return back()->withErrors(['book_id' => 'No borrow record found for this book.']);
            }
        
            $lastBorrowRecord->returned_at = now();
            $lastBorrowRecord->save();
        
            $book = Book::findOrFail($bookId);
            $book->availability = 1;
            $book->save();
        
            return redirect()->route('browse.index')
                ->with('success', 'Book returned successfully!');
        }
         
       
        else if ($request->get('submit') == 'purchies') {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'book_id' => 'required',
            ]);

            $userId = decrypt($validatedData['user_id']);
            $bookId = decrypt($validatedData['book_id']);
            $book = Book::findOrFail($bookId);
            $purchase = new Purchase();
            $purchase->user_id = $userId;
            $purchase->book_id = $bookId;
            $reservation = Reservation::where('user_id', $userId)
                ->where('book_id', $bookId)
                ->where('status', 'still')
                ->first();


            if ($reservation) {
                $reservation->status = "done";
                $reservation->save();
            }
            $purchase->purchase_date = now();
            $purchase->save();

            $book->availability = 0;
            $book->save();
            return redirect()->route('browse.show', ['id' => $bookId])->with('success', 'Book purchased successfully!');
        } else if ($request->get('submit') == 'reserve') {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'book_id' => 'required',
            ]);
            $userI = auth()->id();
            $use=User::findOrFail($userI);
            if($use->hasPenalty('1')){redirect()->route('home')->with('error', 'low penalties.');}
            $userId = decrypt($validatedData['user_id']);
            $bookId = decrypt($validatedData['book_id']);

            $book = Book::findOrFail($bookId);


            
            $reservation = new Reservation();
            $reservation->user_id = $userId;
            $reservation->book_id = $bookId;
            $reservation->status =  "still";
            $reservation->reservation_date = now(); 
            $reservation->save();
           
            Log::info('Reservation record saved: ' . $reservation->id);

            return redirect()->route('browse.show', ['id' => $bookId])->with('success', 'Book reserved successfully!');
        }

    }
}
