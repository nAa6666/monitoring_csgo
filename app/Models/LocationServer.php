<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationServer extends Model{

    protected $connection = 'mysql';
    protected $table = 'location';
    public $timestamps = false;
}
