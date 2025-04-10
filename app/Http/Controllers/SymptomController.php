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
            ->orderByRaw("date DESC, FIELD(time, '1', '2', '3') DESC, created_at DESC")
            ->take(10)->get();
        return SymptomResource::collection($symptom);
    }

    /**
     * Store a new Symptom entry
     */
    public function store(Request $request)
    {
        $data = $this->validateSymptomRequest($request);

        $formatted_data = $this->formatSymptomRequestData($data);

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
     * Update a Symptom entry
     */
    public function update(Request $request, Symptom $symptom)
    {
        $data = $this->validateSymptomRequest($request);

        $formatted_data = $this->formatSymptomRequestData($data);
        
        $symptom->update($formatted_data);

        return response()->json([
            'status' => 'success',
            'message' => 'Symptom updated successfully',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptom $symptom)
    {
        //
    }

    private function validateSymptomRequest(Request $request) {
        return $request->validate([
            'date' => ['required', 'date'],
            'timeOfDay' => ['required', 'in:' . implode(',', array_column(TimeType::cases(), 'name'))],
            'type' => ['required', 'string', 'max:255'],
        ]);
    }

    private function formatSymptomRequestData($data) {
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
        return $formatted_data;
    }
}
