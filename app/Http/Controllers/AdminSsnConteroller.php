<?php

namespace App\Http\Controllers;

use App\Models\Ssn;
use Illuminate\Http\Request;

class AdminSsnConteroller extends Controller
{
    public function index(Request $request)
    {
        $query = Ssn::query(); 

        if ($request->has('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('dob', 'like', "%$search%")
                  ->orWhere('address', 'like', "%$search%")
                  ->orWhere('city', 'like', "%$search%")
                  ->orWhere('state', 'like', "%$search%")
                  ->orWhere('zip', 'like', "%$search%")
                  ->orWhere('ssn', 'like', "%$search%")
                  ->orWhere('year', 'like', "%$search%")
                  ->orWhere('country', 'like', "%$search%");
            });
        }

        $ssns = $query->paginate(10)->appends(request()->query());

        return view('admin.ssns.index', compact('ssns'));
    }



    public function create()
    {
        return view('admin.ssns.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'ssn' => 'required|string|unique:ssns,ssn',
            'year' => 'required|integer',
            'country' => 'required|string',
        ]);

        Ssn::create($request->all());

        return redirect()->route('admin.ssns.index')->with('success', 'SSN added successfully');
    }

    public function show(Ssn $ssn)
    {
        return view('admin.ssns.show', compact('ssn'));
    }

    public function edit(Ssn $ssn)
    {
        return view('admin.ssns.edit', compact('ssn'));
    }

    public function update(Request $request, Ssn $ssn)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'ssn' => 'required|string|unique:ssns,ssn,' . $ssn->id,
            'year' => 'required|integer',
            'country' => 'required|string',
        ]);

        $ssn->update($request->all());

        return redirect()->route('admin.ssns.index')->with('success', 'SSN updated successfully');
    }

    public function destroy(Ssn $ssn)
    {
        $ssn->delete();
        return redirect()->route('admin.ssns.index')->with('success', 'SSN deleted successfully');
    }
}
