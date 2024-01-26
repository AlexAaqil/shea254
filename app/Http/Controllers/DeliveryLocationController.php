<?php

namespace App\Http\Controllers;

use App\Models\DeliveryLocation;
use Illuminate\Http\Request;

class DeliveryLocationController extends Controller
{
    public function index()
    {
        $delivery_locations = DeliveryLocation::latest()->get();
        return view('admin.delivery_locations.delivery_locations', compact('delivery_locations'));
    }

    public function create()
    {
        return view('admin.delivery_locations.add_location');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location_name' => 'required|string|max:100|unique:delivery_locations',
        ]);

        DeliveryLocation::create([
            'location_name' => $validated['location_name'],
        ]);

        return redirect()->route('locations.index')->with('success', [
            'message' => 'Delivery Location has been added!',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function edit(DeliveryLocation $location)
    {
        return view('admin.delivery_locations.update_location', compact('location'));
    }

    public function update(Request $request, DeliveryLocation $location)
    {
        $request->validate([
            'location_name' => 'required|string|max:100|unique:delivery_locations,location_name,' . $location->id,
        ]);

        $location->update([
            'location_name'=>$request->input('location_name'),
        ]);

        return redirect()->route('locations.index')->with('success', [
            'message' => 'Delivery Location has been updated.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function destroy(DeliveryLocation $location)
    {
        $location->delete();

        return redirect()->route('locations.index')->with('success', [
            'message' => 'Delivery Location and associated areas have been deleted.',
            'duration' => $this->alert_message_duration,
        ]);
    }
}
