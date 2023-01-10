<?php

namespace App\Console\Commands;

use App\Models\RoomDetails;
use Carbon\Carbon;
use Illuminate\Console\Command;

use Faker;
use MongoDB\BSON\UTCDateTime;

class FillDBFake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:db {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $id = (int)$this->option('id');
        $faker = Faker\Factory::create();
        $entries = collect();
        for($i = 0; $i < 60*24 ; $i++){
            $entries->push([
                'RoomNo' => 'Room ' . $id,
                'Temperature' => $faker->numberBetween(20,24),
                'Humidity' => $faker->numberBetween(26,35),
                'Pressure' => $faker->numberBetween(100000,102000),
                'Light' => $faker->numberBetween(60,85),
                'Sound' => $faker->numberBetween(220,290),
                'timestamp' => new UTCDateTime(Carbon::now()->addMinutes($i)->getTimestamp())
            ]);
        //sleep(60);
        }
        RoomDetails::insert($entries->toArray());
        $this->line("Entries were added successfully");
        return Command::SUCCESS;
    }
}
