<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Town;

class LocationController extends Controller
{
    public function list()
    {
        $cities = City::latest()->get();
        $towns = Town::latest()->get();
        return view('admin.list_locations', compact('cities', 'towns'));
    }

    public function get_add_city()
    {
        return view('admin.add_city');
    }

    public function post_add_city(Request $request)
    {
        $validated = $request->validate([
            'city_name' => 'required|string|max:100|unique:cities',
        ]);

        City::create([
            'city_name' => $validated['city_name'],
        ]);

        return redirect()->route('list_locations')->with('success', [
            'message' => 'City has been added!',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function get_add_town()
    {
        $cities = City::all();
        return view('admin.add_town', compact('cities'));
    }

     public function post_add_town(Request $request)
    {
        $validated = $request->validate([
            'town_name' => 'required|string|max:100|unique:towns',
            'city_id' => 'required',
        ]);

        Town::create([
            'city_id' => $validated['city_id'],
            'town_name' => $validated['town_name'],
            'price' => $request->price,
        ]);

        return redirect()->route('list_locations')->with('success', [
            'message' => 'Town has been added!',
            'duration' => $this->alert_message_duration,
        ]);
    }
}
