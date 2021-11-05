<?php

use App\Models\Entry;
use App\Models\Keyboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/keyboards', function(Request $request) {
   return Keyboard::select(['id', 'name'])->with('entries')->get();
});

Route::middleware('throttle:5,3')->post('/check', function(Request $request) {
   $validated_data = $request->validate([
       'code' => 'required|exists:keyboards,code'
   ]);

    return response()->json(['message' => 'Code is valid']);
});

Route::middleware('throttle:2,60')->post('/create', function(Request $request) {
    $validated_data = $request->validate([
       'display_name' => 'required',
        'country' => 'required',
        'date_recieved' => 'required',
        'shipping_cost' => 'required',
        'currency' => 'required',
        'note' => 'required',
        'code' => 'required|exists:keyboards,code'
    ]);

    $keyboard = Keyboard::where('code', $validated_data['code'])->first();

    // If the code has got past validation it's all good
    unset($validated_data['code']);

    return $keyboard->entries()->create($validated_data);
});
