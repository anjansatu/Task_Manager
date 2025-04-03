<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Models\DepositMethod;
use Illuminate\Support\Facades\Auth;

class UserDepositController extends Controller
{
    public function index()
    {
        $data['deposits'] = Deposit::with('depositMethod')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        // dd($data['deposits']);
        return view('user.deposits.index',$data);
    }

    /**
     * Show the form for creating a new deposit.
     */
    public function create()
    {
        $data['methods'] = DepositMethod::all();
        return view('user.deposits.create',$data);
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
