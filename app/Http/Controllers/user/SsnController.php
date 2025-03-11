<?php

namespace App\Http\Controllers\user;

use App\Models\Ssn;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SsnController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('id', Auth::id())->first();

        if (!$user || $user->status != STATUS_ACTIVE) {
            return redirect()->back()->with('error', 'Please deposit and activate your SSN');
        }

        $query = Ssn::with('price');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('dob', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('state', 'like', "%{$search}%")
                  ->orWhere('zip', 'like', "%{$search}%")
                  ->orWhere('ssn', 'like', "%{$search}%")
                  ->orWhere('year', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%");
            });
        }

        $data['ssns'] = $query->paginate(10);

        return view('user.ssn.index', $data);
    }


}
