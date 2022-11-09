<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameMode extends Model{

    protected $connection = 'mysql';
    protected $table = 'game_mode';
    public $timestamps = false;
}
