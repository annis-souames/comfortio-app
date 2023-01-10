<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomDetails;
use Carbon\Carbon;


class RoomController extends Controller
{
    /**
     * Get the data for a given room the id parameter
     * @param Request $request
     */

    public function getSummary(Request $request){
            $rooms = config("mapping.rooms_id");
            $data = collect([]);
            foreach ($rooms as $id=>$name){
                $roomData = RoomDetails::where('RoomNo',$name)->get()->last();
                if($roomData)
                    $data->push([
                        "id" => $id,
                        "temperature" => $roomData['Temperature'],
                        "humidity" => $roomData['Humidity'],
                        "light" => $roomData['Light'],
                        "sound" => $roomData['Sound']
                    ]);
            }
            return response()->json($data);

    }

    public function getRoomData(Request $request){

        $roomID = $request->get('id');
        $since = $request->get('since');
        $startDate = Carbon::now()->subMinutes($since);
        $freq = $request->get('by');
        $roomNumber = config('mapping.rooms_id')[$roomID];
        //dd($roomNumber);
        $roomData = RoomDetails::where('RoomNo',$roomNumber)->get()->sortBy('timestamp');
        $timestamps = $roomData->pluck("timestamp");
        $fullData = [
            "temperature" => $timestamps->combine($roomData->pluck('Temperature')),
            "humidity" => $timestamps->combine($roomData->pluck('Humidity'))
        ];

        $data = [
            "temperature" => $roomData->pluck('Temperature'),
            "humidity" => $roomData->pluck('Humidity'),
            "sound" => $roomData->pluck('Sound'),
            "light" => $roomData->pluck('Light')
        ];
        $respData = [];
        if($freq == 'H'){
            foreach ($data as $k=>$serie){
                $respData[$k] = $this->AvgByFreq($serie->toArray(),60);
            }
        }
        elseif ($freq == 'M'){
            foreach ($data as $k=>$serie){
                $respData[$k] = $serie->take(-60)->values();
            }
        }

        return response()->json($respData);
    }

    public function AvgByFreq($data,$average_for){
        $n = 60;
        $number_of_avg = floor(count($data)/$n);
        $averages = [];
        for($i=0; $i < $number_of_avg ; $i++ ){
            $sliced = array_slice($data,$i*$n,$n);
            $avg = array_sum($sliced)/$n;
            array_push($averages,$avg);
        }

        return $averages;
    }
}
