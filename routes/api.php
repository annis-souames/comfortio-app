<?php

use App\Models\RoomDetails;
use Carbon\Carbon;
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

Route::get('/details', function(Request $request){
    $roomID = $request->get('id');
    $since = $request->get('since');
    $startDate = Carbon::now()->subMinutes($since);
    $roomNumber = config('mapping.rooms_id')[$roomID];
    //dd($roomNumber);
    $roomData = RoomDetails::where('RoomNo',$roomNumber)->where('timestamp','>=',$startDate)->get()->sortBy('timestamp');

    return response()->json($roomData);
});
