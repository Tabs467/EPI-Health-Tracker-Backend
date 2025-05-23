<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Resources\FoodResource;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Enums\TimeType;
use App\Enums\SizeType;
use App\Enums\SpiceType;
use App\Enums\FatType;
use App\Enums\CaffeineType;

class FoodController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of type FoodResource
     */
    public function index()
    {
        $food = auth()->user()->food()
            ->orderByRaw("date DESC, FIELD(time, '1', '2', '3') DESC, created_at DESC")
            ->take(10)->get();
        return FoodResource::collection($food);
    }

    /**
     * Store a new Food entry
     */
    public function store(Request $request)
    {
        $data = $this->validateFoodRequest($request);

        $formatted_data = $this->formatFoodRequestData($data);

        auth()->user()->food()->create($formatted_data);

        return response()->json([
            'status' => 'success',
            'message' => 'Food created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Update a Food entry
     */
    public function update(Request $request, Food $food)
    {
        $data = $this->validateFoodRequest($request);

        $formatted_data = $this->formatFoodRequestData($data);

        $food->update($formatted_data);

        return response()->json([
            'status' => 'success',
            'message' => 'Food updated successfully',
        ], 201);
    }

    /**
     * Remove the specified Food from storage
     */
    public function destroy(Food $food)
    {
        $food->delete();
    }

    private function validateFoodRequest(Request $request) {
        return $request->validate([
            'date' => ['required', 'date'],
            'timeOfDay' => ['required', 'in:' . implode(',', array_column(TimeType::cases(), 'name'))],
            'foodTitle' => ['required', 'string', 'max:255'],
            'size' => ['required', 'in:' . implode(',', array_column(SizeType::cases(), 'name'))],
            'spiceLevel' => ['required', 'in:' . implode(',', array_column(SpiceType::cases(), 'name'))],
            'fatContent' => ['required', 'in:' . implode(',', array_column(FatType::cases(), 'name'))],
            'caffeine' => ['required', 'in:' . implode(',', array_column(CaffeineType::cases(), 'name'))],
            'gluten' => ['required', 'boolean'],
            'dairy' => ['required', 'boolean'],
            'medication' => ['required', 'integer'],
        ]);
    }

    private function formatFoodRequestData($data) {
        $key_mappings = [
            'timeOfDay' => 'time',
            'foodTitle' => 'food_title',
            'spiceLevel' => 'spice',
            'fatContent' => 'fat',
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
                case "size":
                    $formatted_data[$new_key] = constant(SizeType::class . "::$value")->value;
                    break;
                case "spice":
                    $formatted_data[$new_key] = constant(SpiceType::class . "::$value")->value;
                    break;
                case "fat":
                    $formatted_data[$new_key] = constant(FatType::class . "::$value")->value;
                    break;
                case "caffeine":
                    $formatted_data[$new_key] = constant(CaffeineType::class . "::$value")->value;
                    break;    
                default:
                    $formatted_data[$new_key] = $value;
                    break;
            }
        }
        return $formatted_data;
    }
}
