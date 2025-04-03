<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Models\DepositMethod;

class AdminDepositController extends Controller
{
        public function index()
        {
            $deposits = Deposit::with('user')
                ->latest()
                ->paginate(10);
        
            return view('admin.deposits.index', compact('deposits'));
        }


    /**
     * Show a specific deposit.
     */
    public function show($id)
    {
        $deposit = Deposit::with('user')->findOrFail($id);
        return view('admin.deposits.show', compact('deposit'));
    }

    /**
     * Update the deposit status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,failed',
        ]);

        $deposit = Deposit::findOrFail($id);
        $deposit->status = $request->status;
        $deposit->save();

        if ($request->status === 'confirmed') {
            $user = $deposit->user;

            if ($user) {
                $user->status = STATUS_ACTIVE;

                $user->increment('balance', $deposit->amount);

                $user->save();
            }
        }

        return redirect()->back()->with('success', 'Deposit status updated successfully. User balance has been updated.');
    }

    public function depositMethods()
    {
        $methods = DepositMethod::get();
        
        return view('admin.deposits.methods', compact('methods'));
    }

    // Store new deposit method
    public function storeDepositMethods(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',  // Adding address validation
        ]);

        // Create the deposit method
        DepositMethod::create([
            'name' => $request->name,
            'address' => $request->address,  // Storing address
        ]);

        return redirect()->back()->with('success', 'Deposit method added successfully.');
    }

    // Delete a deposit method
    public function destroyDepositMethods($id)
    {
        $method = DepositMethod::findOrFail($id);
        $method->delete();

        return redirect()->back()->with('success', 'Deposit method deleted successfully.');
    }


}
