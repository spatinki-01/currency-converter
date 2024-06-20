<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function homeView()
    {
        $currencyData = $this->fetchCurrencyData();

        // Retrieve values from the session
        $amount = session('amount');
        $fromCurrency = session('fromCurrency');
        $toCurrency = session('toCurrency');
        $convertedAmount = session('convertedAmount');

        return view('home', compact('currencyData', 'amount', 'fromCurrency', 'toCurrency', 'convertedAmount'));
    }

    public function getAmount(Request $request)
    {
        // Validate the request data
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'fromCurrency' => 'required|string|size:3',
            'toCurrency' => 'required|string|size:3',
        ]);

        $amount = $request->input('amount');
        $fromCurrency = $request->input('fromCurrency');
        $toCurrency = $request->input('toCurrency');
        $apiKey = env('CURRENCY_API_KEY');

        // Send request to external API
        $response = Http::get("https://api.freecurrencyapi.com/v1/latest", [
            'apikey' => $apiKey,
            'currencies' => "{$toCurrency},{$fromCurrency}"
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            $data = $response->json()['data'];
            $exchangeRate = $data[$toCurrency] ?? null;

            if ($exchangeRate) {
                // Convert the amount
                $convertedAmount = $amount * $exchangeRate;

                // Store values in the session
                session([
                    'amount' => $amount,
                    'fromCurrency' => $fromCurrency,
                    'toCurrency' => $toCurrency,
                    'convertedAmount' => $convertedAmount
                ]);

                return redirect()->route('home');
            } else {
                return redirect()->back()->with('error', 'Invalid target currency.');
            }
        } else {
            return redirect()->back()->with('error', 'API request failed.');
        }
    }

    private function fetchCurrencyData()
    {
        $apiKey = env('CURRENCY_API_KEY');
        $response = Http::get("https://api.freecurrencyapi.com/v1/currencies", [
            'apikey' => $apiKey
        ]);

        $currencyData = [];
        $json_data = $response->json()['data'];

        foreach ($json_data as $code => $currency) {
            $currencyData[] = [
                'name' => $currency['name'],
                'symbol' => $currency['symbol_native'],
                'code' => $code
            ];
        }

        return $currencyData;
    }
}
