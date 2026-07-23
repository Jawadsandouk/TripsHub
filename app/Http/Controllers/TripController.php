<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\TripStop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('trips.index', compact('trips'));
    }

    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
    }

    // Show the form for creating a multi-stop tour
    public function createMulti()
    {
        return view('trips.create-multi');
    }

    // Store a new multi-stop tour
    public function storeMulti(Request $request)
    {
        $request->validate([
            'seat_price'       => 'required|numeric',
            'duration'         => 'required|string',
            'food_policy'      => 'required|in:Allowed,Not Allowed',
            'area_serviced'    => 'required|in:Serviced,Not Serviced',
            'available_seats'  => 'required|integer|min:1',
            'departure_time'   => 'required|date_format:Y-m-d\TH:i',
            'trip_type'        => 'required|string',
            'image'            => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'place_name_ar'    => 'required|string',
            'description_ar'   => 'required|string',
            'meeting_point_ar' => 'required|string',
            'place_name_en'    => 'required|string',
            'description_en'   => 'required|string',
            'meeting_point_en' => 'required|string',
            'stops'                 => 'required|array|min:1',
            'stops.*.place_name_ar' => 'required|string',
            'stops.*.place_name_en' => 'required|string',
            'stops.*.description_ar'=> 'nullable|string',
            'stops.*.description_en'=> 'nullable|string',
            'stops.*.stop_duration' => 'required|numeric|min:0.25|max:6',
            'stops.*.stop_order'    => 'required|integer|min:1',
            'latitude'              => 'nullable|numeric|between:-90,90',
            'longitude'             => 'nullable|numeric|between:-180,180',
            'stops.*.latitude'      => 'nullable|numeric|between:-90,90',
            'stops.*.longitude'     => 'nullable|numeric|between:-180,180',
            'sub_images'            => 'nullable|array|max:5',
            'sub_images.*'          => 'image|mimes:jpg,jpeg,png,webp|max:3072',
            'stops.*.sub_images'    => 'nullable|array|max:5',
            'stops.*.sub_images.*'  => 'image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trips', 'public');
        }

        $officeDiscount = $request->filled('office_discount') ? $request->office_discount : null;

        $trip = Trip::create([
            'place_name'       => $request->place_name_en,
            'seat_price'       => $request->seat_price,
            'office_discount'  => $officeDiscount,
            'duration'         => $request->duration,
            'food_policy'      => $request->food_policy,
            'area_serviced'    => $request->area_serviced,
            'available_seats'  => $request->available_seats,
            'departure_time'   => $request->departure_time,
            'meeting_point'    => $request->meeting_point_en,
            'description'      => $request->description_en,
            'status'           => 'open',
            'trip_type'        => $request->trip_type,
            'image'            => $imagePath,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'user_id'          => Auth::id(),
            'place_name_ar'    => $request->place_name_ar,
            'place_name_en'    => $request->place_name_en,
            'description_ar'   => $request->description_ar,
            'description_en'   => $request->description_en,
            'meeting_point_ar' => $request->meeting_point_ar,
            'meeting_point_en' => $request->meeting_point_en,
        ]);

        // Save trip sub-images
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $order => $file) {
                $path = $file->store('trips/sub-images', 'public');
                $trip->images()->create(['image_path' => $path, 'order' => $order]);
            }
        }

        // Save stops
        foreach ($request->stops as $stopData) {
            $stopImage = null;
            if (isset($stopData['image']) && $stopData['image'] instanceof \Illuminate\Http\UploadedFile) {
                $stopImage = $stopData['image']->store('trip-stops', 'public');
            }

            $stop = $trip->stops()->create([
                'place_name'    => $stopData['place_name_ar'],
                'place_name_ar' => $stopData['place_name_ar'],
                'place_name_en' => $stopData['place_name_en'],
                'description'   => $stopData['description_ar'] ?? '',
                'description_ar'=> $stopData['description_ar'] ?? '',
                'description_en'=> $stopData['description_en'] ?? '',
                'image'         => $stopImage,
                'latitude'      => $stopData['latitude'] ?? null,
                'longitude'     => $stopData['longitude'] ?? null,
                'stop_duration' => $stopData['stop_duration'],
                'stop_order'    => $stopData['stop_order'] ?? 0,
            ]);

            // Save stop sub-images
            if (isset($stopData['sub_images'])) {
                foreach ($stopData['sub_images'] as $order => $file) {
                    $path = $file->store('trip-stops/sub-images', 'public');
                    $stop->images()->create(['image_path' => $path, 'order' => $order]);
                }
            }
        }

        return redirect()->route('office.trips.index')->with('success', 'Multi-stop tour created successfully');
    }

    // Show the form for editing an existing trip
    public function edit(Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        if ($trip->status !== 'open') {
            return redirect()->route('office.trips.index')->with('error', 'Cannot edit a '.$trip->status.' trip.');
        }

        return view('trips.edit', compact('trip'));
    }

    // Update the specified trip in the database
    public function update(Request $request, Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        if ($trip->status !== 'open') {
            return redirect()->route('office.trips.index')->with('error', 'Cannot edit a '.$trip->status.' trip.');
        }

        $request->validate([
            'seat_price'       => 'required|numeric',
            'duration'         => 'required|string',
            'food_policy'      => 'required|in:Allowed,Not Allowed',
            'area_serviced'    => 'required|in:Serviced,Not Serviced',
            'available_seats'  => 'required|integer|min:1',
            'departure_time'   => 'required|date_format:Y-m-d\TH:i',
            'trip_type'        => 'required|string',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'place_name_ar'    => 'required|string',
            'description_ar'   => 'required|string',
            'meeting_point_ar' => 'required|string',
            'place_name_en'    => 'required|string',
            'description_en'   => 'required|string',
            'meeting_point_en' => 'required|string',
            'stops'                 => 'nullable|array',
            'stops.*.place_name_ar' => 'required_with:stops|string',
            'stops.*.place_name_en' => 'required_with:stops|string',
            'stops.*.description_ar'=> 'nullable|string',
            'stops.*.description_en'=> 'nullable|string',
            'stops.*.stop_duration' => 'required_with:stops|numeric|min:0.25|max:6',
            'stops.*.stop_order'    => 'required_with:stops|integer|min:1',
            'latitude'              => 'nullable|numeric|between:-90,90',
            'longitude'             => 'nullable|numeric|between:-180,180',
            'stops.*.latitude'      => 'nullable|numeric|between:-90,90',
            'stops.*.longitude'     => 'nullable|numeric|between:-180,180',
            'sub_images'            => 'nullable|array|max:5',
            'sub_images.*'          => 'image|mimes:jpg,jpeg,png,webp|max:3072',
            'delete_sub_images'     => 'nullable|array',
            'delete_sub_images.*'   => 'integer|exists:trip_images,id',
            'stops.*.sub_images'    => 'nullable|array|max:5',
            'stops.*.sub_images.*'  => 'image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $imagePath = $trip->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trips', 'public');
        }

        $officeDiscount = $request->filled('office_discount') ? $request->office_discount : null;

        $trip->update([
            'place_name'       => $request->place_name_en,
            'seat_price'       => $request->seat_price,
            'office_discount'  => $officeDiscount,
            'duration'         => $request->duration,
            'food_policy'      => $request->food_policy,
            'area_serviced'    => $request->area_serviced,
            'available_seats'  => $request->available_seats,
            'departure_time'   => $request->departure_time,
            'meeting_point'    => $request->meeting_point_en,
            'description'      => $request->description_en,
            'trip_type'        => $request->trip_type,
            'image'            => $imagePath,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'place_name_ar'    => $request->place_name_ar,
            'place_name_en'    => $request->place_name_en,
            'description_ar'   => $request->description_ar,
            'description_en'   => $request->description_en,
            'meeting_point_ar' => $request->meeting_point_ar,
            'meeting_point_en' => $request->meeting_point_en,
        ]);

        // Handle trip sub-images
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $order => $file) {
                $path = $file->store('trips/sub-images', 'public');
                $trip->images()->create(['image_path' => $path, 'order' => $order]);
            }
        }

        // Delete checked trip sub-images
        if ($request->filled('delete_sub_images')) {
            $trip->images()->whereIn('id', $request->delete_sub_images)->delete();
        }

        // Sync stops if provided
        if ($request->has('stops')) {
            $existingStopIds = $trip->stops()->pluck('id')->toArray();
            $submittedStopIds = [];

            foreach ($request->stops as $stopData) {
                $stopImage = null;
                if (isset($stopData['image']) && $stopData['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $stopImage = $stopData['image']->store('trip-stops', 'public');
                }

                $data = [
                    'place_name'    => $stopData['place_name_ar'],
                    'place_name_ar' => $stopData['place_name_ar'],
                    'place_name_en' => $stopData['place_name_en'],
                    'description'   => $stopData['description_ar'] ?? '',
                    'description_ar'=> $stopData['description_ar'] ?? '',
                    'description_en'=> $stopData['description_en'] ?? '',
                    'image'         => $stopImage,
                    'latitude'      => $stopData['latitude'] ?? null,
                    'longitude'     => $stopData['longitude'] ?? null,
                    'stop_duration' => $stopData['stop_duration'],
                    'stop_order'    => $stopData['stop_order'] ?? 0,
                ];

                if (!empty($stopData['id'])) {
                    $stop = TripStop::find($stopData['id']);
                    if ($stop && $stop->trip_id === $trip->id) {
                        $stop->update($data);
                        $submittedStopIds[] = $stop->id;
                        $this->handleStopSubImages($stop, $stopData);
                    }
                } else {
                    $stop = $trip->stops()->create($data);
                    $submittedStopIds[] = $stop->id;
                    $this->handleStopSubImages($stop, $stopData);
                }
            }

            $toDelete = array_diff($existingStopIds, $submittedStopIds);
            if (!empty($toDelete)) {
                TripStop::whereIn('id', $toDelete)->delete();
            }
        }

        return redirect()->route('office.trips.index')->with('success', __('Trip updated successfully'));
    }

    // Upload an image for a trip
    public function uploadImage(Request $request, Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('trips', 'public');
        $trip->update(['image' => $imagePath]);

        return back()->with('success', 'Image uploaded successfully');
    }

    // Cancel a trip (Office only - sets status to canceled)
    public function cancel(Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        if ($trip->status !== 'open') {
            return redirect()->route('office.trips.index')->with('error', 'Can only cancel open trips.');
        }

        $trip->update(['status' => 'canceled']);

        return redirect()->route('office.trips.index')->with('success', 'Trip canceled successfully');
    }

    // Remove the specified trip from the database
    public function destroy(Trip $trip)
    {
        if ($trip->user_id !== Auth::id()) {
            abort(403);
        }

        $trip->delete();

        return redirect()->route('office.trips.index')->with('success', 'Trip deleted successfully');
    }

    private function handleStopSubImages($stop, $stopData)
    {
        if (!isset($stopData['sub_images'])) return;

        $existingMax = $stop->images()->max('order') ?? -1;
        foreach ($stopData['sub_images'] as $order => $file) {
            if ($file instanceof \Illuminate\Http\UploadedFile) {
                $path = $file->store('trip-stops/sub-images', 'public');
                $stop->images()->create([
                    'image_path' => $path,
                    'order' => $existingMax + 1 + $order,
                ]);
            }
        }
    }
}
