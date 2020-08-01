<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;


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

}
