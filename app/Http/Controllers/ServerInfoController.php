<?php

namespace App\Http\Controllers;

use App\Models\Servers;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ServerInfoController extends Controller
{
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function show($slug){
        //Проверка на правильный ip:port или hostname:port
        if(!preg_match("/(?:[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{5})|(^(?![-.+])[a-z0-9-.+]+\:{1}[0-9]{1,7})/", $slug)){
            return abort(404);
        }else{
            $server_ip = explode(':', $slug)[0];
            $server_port = explode(':', $slug)[1];
        }

        $server = Servers::where(['ip' => $server_ip, 'port' => $server_port])->get()->first();
        if(!$server){
            return abort(404);
        }

        SEOMeta::setTitle('Сервер '.$server->name)
            ->setDescription($server->name.' подключиться по '.$server->ip.':'.$server->port.', сервер работает на мод режиме '.$server->mode.' с локацией '.$server->country.'. Версия: '.$server->version)
            ->setKeywords('Сервер '.$server->name.', '.$server->ip.':'.$server->port.' айпи адрес, мод режим сервера - '.$server->mode);
        OpenGraph::setTitle('Сервер '.$server->name)
            ->setDescription($server->name.' подключиться по '.$server->ip.':'.$server->port.', сервер работает на мод режиме '.$server->mode.' с локацией '.$server->country.'. Версия: '.$server->version);

        return view('pages.server_info', ['server' => $server]);
    }
}
