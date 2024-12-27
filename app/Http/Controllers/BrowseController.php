<?php

namespace App\Http\Controllers;

use App\Models\Borrows;
use Illuminate\Http\Request;
use App\Models\Book;
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
        $userId = auth()->id(); // it is working to get the user id, don't delete it
        $hasPurchased = Purchase::where('user_id', $userId)
            ->where('book_id', $book->id)
            ->exists();

        // Check if the user has a reservation with status 'still'
        $hasReserved = Reservation::where('user_id', $userId)
            ->where('book_id', $book->id)
            ->where('status', 'still')
            ->exists();

        // Check if this is the first reservation with status 'still'
        $isFirstReservation = Reservation::where('book_id', $book->id)
            ->where('status', 'still')
            ->orderBy('reservation_date', 'asc')
            ->first();

        $isUserFirstReservation = $isFirstReservation && $isFirstReservation->user_id === $userId;

        $isReservedDone = Reservation::where('book_id', $book->id)
            ->where('status', 'done')
            ->exists();

        $isReserved = Reservation::where('book_id', $book->id)->exists();




        return view('browse.show', compact('book', 'hasPurchased', 'isUserFirstReservation', 'isReservedDone', 'isReserved', 'hasReserved'));
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

            Log::info('Validated data: ', $validatedData);

            $userId = decrypt($validatedData['user_id']);
            $bookId = decrypt($validatedData['book_id']);

            Log::info('Decrypted user_id: ' . $userId);
            Log::info('Decrypted book_id: ' . $bookId);

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

            Log::info('Borrow record saved: ' . $borrow->id);

            // Update book availability
            $book->availability = false;
            $book->save();

            return redirect()->route('browse.index')->with('success', 'Book borrowed successfully!');
        } else if ($request->get('submit') == 'purchies') {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'book_id' => 'required',
            ]);

            $userId = decrypt($validatedData['user_id']);
            $bookId = decrypt($validatedData['book_id']);

            $book = Book::findOrFail($bookId);

            // Create the purchase record
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

            $purchase->save();

            $book->availability = 0;
            $book->save();




            return redirect()->route('browse.show', ['id' => $bookId])->with('success', 'Book purchased successfully!');
        } else if ($request->get('submit') == 'reserve') {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'book_id' => 'required',
            ]);

            $userId = decrypt($validatedData['user_id']);
            $bookId = decrypt($validatedData['book_id']);

            $book = Book::findOrFail($bookId);

            // Create the reservation record
            $reservation = new Reservation();
            $reservation->user_id = $userId;
            $reservation->book_id = $bookId;
            $reservation->status =  "still";

            $reservation->save();

            Log::info('Reservation record saved: ' . $reservation->id);

            return redirect()->route('browse.show', ['id' => $bookId])->with('success', 'Book reserved successfully!');
        }
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
