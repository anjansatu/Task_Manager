<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;

class AdminPriceController extends Controller
{
    public function index()
    {
        $price = Price::all();
        return view('admin.price.index', compact('price'));
    }

    public function create()
    {
        return view('admin.price.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        Price::create($request->all());

        return redirect()->route('admin.price.index')->with('success', 'price created successfully.');
    }

    public function edit(Price $price)
    {
        return view('admin.price.edit', compact('price'));
    }

    public function update(Request $request, Price $price)
    {
        $request->validate([
            'price' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        $price->update($request->all());

        return redirect()->route('admin.price.index')->with('success', 'Price updated successfully.');
    }

    public function destroy(Price $price)
    {
        $price->delete();
        return redirect()->route('admin.price.index')->with('success', 'price deleted successfully.');
    }
}
