<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\MapGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    public function saveLocation(Request $request)
    {
        Log::info('Saving location', $request->all());
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $location = Location::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'status' => Auth::user()->status,
            ]
        );
        Log::info('Location saved', ['location' => $location]);
        return response()->json(['success' => true, 'location' => $location]);
    }
    

    public function showLocations(Request $request)
    {
    if (auth()->user()->adminOfGroup()->count() < 1){
        MapGroup::create([
            'name' => auth()->user()->name,
            'admin_id' => auth()->user()->id,
        ]);
    }
        $locations = Location::all();
        return view('location.admin_map', compact('locations'));
    }


    public function deleteLocation()
    {
        $location = Location::where('user_id', Auth::id())->first();
        if ($location) {
            $location->delete();
            return response()->json(['success' => true, 'message' => 'Location deleted.']);
        } else {
            return response()->json(['success' => false, 'message' => 'No location found.']);
        }
    }

    public function getLocations()
    {   
    $locations = Location::where('user_id', Auth::user()->id)->whereIn('status', ['active', 'critical'])
        ->get(['latitude', 'longitude', 'status']);
    return response()->json($locations);
    }
}
