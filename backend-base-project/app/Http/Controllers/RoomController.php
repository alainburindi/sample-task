<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function index()
    {
        return Room::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'floor_number' => 'required|integer',
            'room_number' => 'required|integer',
            'capacity' => 'required|integer',
            'status' => 'required|in:READY,TAKEN,MAINTENANCE',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        return Room::create($validated);
    }

    public function show(Room $room)
    {
        return $room;
    }

    public function update(Request $request, Room $room)
    {
        $validator = Validator::make($request->all(), [
            'floor_number' => 'sometimes|required|integer',
            'room_number' => 'sometimes|required|integer',
            'capacity' => 'sometimes|required|integer',
            'status' => 'sometimes|required|in:READY,TAKEN,MAINTENANCE',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();
        $room->update($validated);
        return $room;
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->noContent();
    }

    public function setAsReady(Room $room)
    {
        $room->update(['status' => 'READY']);
        return $room;
    }

    public function assignRoom(Request $request, Room $room)
    {
        $room->update(['status' => 'TAKEN']);
        // Here we can add the guest_id to the room
        return $room;
    }

    public function deassignRoom(Room $room)
    {
        $room->update(['status' => 'MAINTENANCE']);
        return $room;
    }
}
