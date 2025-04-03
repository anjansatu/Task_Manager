<?php

namespace App\Http\Controllers\user;

use App\Models\Ssn;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderHistory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SsnController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->status !== STATUS_ACTIVE) {
            return redirect()->back()->with('error', 'Please deposit and activate your SSN');
        }

        $query = Ssn::with('price');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('state', 'like', "%{$search}%")
                    ->orWhere('zip', 'like', "%{$search}%")
                    ->orWhere('ssn', 'like', "%{$search}%")
                    ->orWhere('dob', 'like', "%{$search}%")
                    ->orWhere('year', 'like', "%{$search}%")
                    ->orWhere('country', 'like', "%{$search}%");
            });
        }

        $data['ssns'] = $query->paginate(10);

        return view('user.ssn.index', $data);
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'ssn_id' => 'required|exists:ssns,id',
        ]);

        $ssn = Ssn::findOrFail($request->ssn_id);

        DB::transaction(function () use ($ssn) {
            $user = Auth::user();

            $amountToDeduct = $ssn->price ? $ssn->price->amount : 0.50;
            if ($user->balance < $amountToDeduct) {
                throw new \Exception('Insufficient balance');
            }

            $user->balance -= $amountToDeduct;
            $user->save();

            $order = Order::create([
                'user_id' => $user->id,
                'order_id' => uniqid('ORD-'),
                'amount' => $amountToDeduct,
                'status' => 'completed',
            ]);

            OrderHistory::create([
                'order_id' => $order->id,
                'first_name' => $ssn->first_name,
                'last_name' => $ssn->last_name,
                'address' => $ssn->address,
                'city' => $ssn->city,
                'state' => $ssn->state,
                'zip' => $ssn->zip,
                'ssn' => $ssn->ssn,
                'dob' => $ssn->dob,
                'year' => $ssn->year,
                'country' => $ssn->country,
            ]);

            $ssn->delete();
        });

        return response()->json(['success' => true]);
    }

    public function history()
    {
        $user = Auth::user();

        $data['ssns'] = Order::where('user_id', $user->id)
            ->with('orderHistory')
            ->paginate(15);

        return view('user.ssn.purchase', $data);
    }


}
