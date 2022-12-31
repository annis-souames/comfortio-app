<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;


class RoomDetails extends Model
{
    protected $collection = 'iot_data';
    protected $connection = 'mongodb';
    protected $dates = ['timestamp'];
}
