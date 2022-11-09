<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servers extends Model{

    public $timestamps = false;
    public $specport = NULL;

    protected $fillable = [
        'name', 'map', 'game', 'players', 'maxplayers', 'bots', 'os',
        'version', 'ip', 'port', 'mode', 'country', 'rating', 'specport',
        'password', 'status', 'add_server_time', 'last_update', 'players_list'
    ];

    protected $casts = [
        'players_list' => 'array'
    ];

    public function game_mode(){
        return $this->hasOne(GameMode::class, 'type', 'mode');
    }

    public function location(){
        return $this->hasOne(LocationServer::class, 'code', 'country');
    }
}
