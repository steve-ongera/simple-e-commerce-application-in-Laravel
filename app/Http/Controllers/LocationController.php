<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:locations,name',
            'delivery_fee' => 'required|numeric|min:0',
        ]);

        Location::create($request->all());

        return redirect()->route('location.index')->with('success', 'Location added successfully!');
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'name' => 'required|string|unique:locations,name,' . $location->id,
            'delivery_fee' => 'required|numeric|min:0',
        ]);

        $location->update($request->all());

        return redirect()->route('location.index')->with('success', 'Location updated successfully!');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('location.index')->with('success', 'Location deleted successfully!');
    }
}
