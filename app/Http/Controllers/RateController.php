<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rate;
use Carbon\Carbon;

class RateController extends Controller
{
    /**
     * Show the latest rates in Blade view.
     */
    public function latestView()
    {
        $date = now()->toDateString();
        $rates = $this->getRatesByDateQuery($date);

        return view('rates', [
            'rates' => $rates
        ]);
    }

    /**
     * Get latest rates in JSON (for API).
     */
    public function latest()
    {
        $date = now()->toDateString();
        return response()->json($this->getRatesByDateQuery($date));
    }

    /**
     * Get rates for a specific date (JSON for API/AJAX).
     */
    public function byDate($date)
    {
        // Ensure date format is valid
        try {
            $date = Carbon::parse($date)->toDateString();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }

        return response()->json($this->getRatesByDateQuery($date));
    }

    /**
     * Private query builder for rates by date.
     */
    private function getRatesByDateQuery($date)
    {
        return Rate::with(['baseCurrency', 'targetCurrency'])
            ->where('effective_date', $date)
            ->get()
            ->map(function ($rate) {
                return [
                    'base' => $rate->baseCurrency->code,
                    'target' => $rate->targetCurrency->code,
                    'rate' => $rate->rate,
                    'effective_date' => $rate->effective_date,
                ];
            });
    }
}
