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

    public function get_update_city($id)
    {
        $city = City::findOrFail($id);
        return view('admin.update_city', compact('city'));
    }

    public function post_update_city(Request $request, $id)
    {
        $validated = $request->validate([
            'city_name' => 'required|unique:cities, city_name,'.$id,
        ]);

        $city = City::findOrFail($id);
        $city->update([
            'city_name'=>$validated['city_name'],
        ]);

        return redirect()->route('list_locations')->with('success', [
            'message' => 'City has been updated.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function delete_city($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('list_locations')->with('success', [
            'message' => 'City and associated towns have been deleted.',
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
            'price' => 'required|numeric',
        ]);

        Town::create([
            'city_id' => $validated['city_id'],
            'town_name' => $validated['town_name'],
            'price' => $validated['price'],
        ]);

        return redirect()->route('list_locations')->with('success', [
            'message' => 'Town has been added!',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function get_update_town($id)
    {
        $cities = City::all();
        $town = Town::findOrFail($id);
        return view('admin.update_town', compact('cities', 'town'));
    }

    public function post_update_town(Request $request, $id)
    {
        $validated = $request->validate([
            'town_name' => 'required|unique:towns,town_name,'.$id,
            'city_id' => 'required',
            'price' => 'required|numeric',
        ]);

        $town = Town::findOrFail($id);
        $town->update([
            'town_name' => $validated['town_name'],
            'city_id' => $validated['city_id'],
            'price' => $validated['price'],
        ]);

        return redirect()->route('list_locations')->with('success', [
            'message' => 'Town has been updated.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function delete_town($id)
    {
        $town = Town::findOrFail($id);
        $town->delete();

        return redirect()->route('list_locations')->with('success', [
            'message' => 'Town has been deleted.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function get_towns($cityId)
    {
        $towns = Town::where('city_id', $cityId)->get();
        return response()->json($towns);
    }

    public function get_shipping_price($townId)
    {
        $town = Town::findOrFail($townId);
        $price = $town->price;

        return response()->json(['price' => $price]);
    }
}
