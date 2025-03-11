<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDepositController extends Controller
{
    public function index()
    {
        $data['deposits'] = Deposit::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('user.deposits.index',$data);
    }

    /**
     * Show the form for creating a new deposit.
     */
    public function create()
    {
        return view('user.deposits.create');
    }

    /**
     * Store a new deposit.
     */
    public function store(Request $request)
    {
        $request->validate([
            'currency_type' => 'required|string',
            'from' => 'required|string',
            'to' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
            'transaction_id' => 'required|string|unique:deposits,transaction_id',
        ]);

        Deposit::create([
            'user_id' => Auth::id(),
            'currency_type' => $request->currency_type,
            'from' => $request->from,
            'to' => $request->to,
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id,
            'status' => 'pending',
        ]);

        return redirect()->route('deposits.index')->with('success', 'Deposit request submitted successfully.');
    }
}
