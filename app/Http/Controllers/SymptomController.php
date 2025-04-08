<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;
use App\Http\Resources\SymptomResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Enums\TimeType;

class SymptomController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of type SymptomResource
     */
    public function index()
    {
        $symptom = auth()->user()->symptoms()
            ->orderByRaw("date DESC, FIELD(time, '3', '2', '1') DESC, created_at DESC")
            ->take(10)->get();
        return SymptomResource::collection($symptom);
    }

    /**
     * Store a new Symptom entry
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => ['required', 'date'],
            'timeOfDay' => ['required', 'in:' . implode(',', array_column(TimeType::cases(), 'name'))],
            'type' => ['required', 'string', 'max:255'],
        ]);

        $key_mappings = [
            'timeOfDay' => 'time',
        ];

        /**
         * Formatting includes:
         * 
         * Mapping API keys to db keys
         * Mapping enum values
         */
        $formatted_data = [];
        foreach ($data as $key => $value) {
            $new_key = $key_mappings[$key] ?? $key;

            switch ($new_key) {
                case "time":
                    $formatted_data[$new_key] = constant(TimeType::class . "::$value")->value;
                    break;
                default:
                    $formatted_data[$new_key] = $value;
                    break;
            }
        }

        auth()->user()->symptoms()->create($formatted_data);

        return response()->json([
            'status' => 'success',
            'message' => 'Symptom created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptom $symptom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Symptom $symptom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        //
    }
}
