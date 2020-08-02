<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Session;


class TransactionController extends Controller
{

    /**
     * Show all transactions
     * @return View
     */
    public function index()
    {
        $transactions = Transaction::all();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show transaction
     * @param Transaction $transaction
     * @return View
     */
    public function show(Transaction $transaction) {
        return view('transactions.show', compact('transaction'));
    }

/**
     * Show create note page
     * @param User $user
     * @return View
     */
    public function notecreate(Transaction $transaction) {
        return view('transactions.createnote', compact('transaction'));
    }

    /**
     * Store a new user note
     * @param Request $request
     * @return redirect
     */
    public function notestore(Transaction $transaction, Request $request) {

        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $note = $transaction->notes()->create([
            'entity_id' => $transaction->id,
            'title' => $request->title,
            'description' => $request->description
        ]);

        Session::flash('message', 'Successfully added note');
        Session::flash('name', $request->title);
        Session::flash('alert-class', 'alert-success');

        return redirect(route('admin.transactions.show', $transaction));
    }

}
