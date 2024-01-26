<?php

namespace App\Http\Controllers;

use App\Models\DeliveryArea;
use App\Models\DeliveryLocation;
use Illuminate\Http\Request;

class DeliveryAreaController extends Controller
{
    public function index()
    {
        $delivery_areas = DeliveryArea::latest()->get();
        return view('admin.delivery_locations.delivery_areas', compact('delivery_areas'));
    }

    public function create()
    {
        $locations = DeliveryLocation::all();
        return view('admin.delivery_locations.add_area', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_id' => 'required',
            'area_name' => 'required|string|max:100|unique:delivery_areas',
            'price' => 'required|numeric',
        ]);

        DeliveryArea::create([
            'location_id' => $request['location_id'],
            'area_name' => $request['area_name'],
            'price' => $request['price'],
        ]);

        return redirect()->route('areas.index')->with('success', [
            'message' => 'Delivery Area has been added!',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function edit(DeliveryArea $area)
    {
        $locations = DeliveryLocation::all();
        return view('admin.delivery_locations.update_area', compact('locations', 'area'));
    }

    public function update(Request $request, DeliveryArea $area)
    {
        $request->validate([
            'location_id' => 'required',
            'area_name' => 'required|string|max:100|unique:delivery_areas,area_name,' . $area->id,' ',
            'price' => 'required|numeric',
        ]);

        $area->update([
            'location_id' => $request->input('location_id'),
            'area_name'=> $request->input('area_name'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('areas.index')->with('success', [
            'message' => 'Delivery Area has been updated.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function destroy(DeliveryArea $area)
    {
        $area->delete();

        return redirect()->route('areas.index')->with('success', [
            'message' => 'Delivery Area has been deleted.',
            'duration' => $this->alert_message_duration,
        ]);
    }
}
