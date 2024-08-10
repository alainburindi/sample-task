<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    public function index()
    {
        return Guest::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'age' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validated = $validator->validated();

        return Guest::create($validated);
    }

    public function show(Guest $guest)
    {
        return $guest;
    }

    public function update(Request $request, Guest $guest)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'sometimes|required|string',
            'age' => 'sometimes|required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $validated = $validator->validated();

        $guest->update($validated);
        return $guest;
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->noContent();
    }
}
