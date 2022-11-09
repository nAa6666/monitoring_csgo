<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TopServers extends Model{
    protected $connection = 'mysql';
    public $timestamps = false;

    protected $table = 'servers';

    protected static function boot(){
        parent::boot();
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->where('top', 1)->orderBy('time_top', 'desc');
        });
    }
}
