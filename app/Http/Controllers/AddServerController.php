<?php

namespace App\Http\Controllers;

use App\Models\GameMode;
use App\Models\Servers;
use App\SourceQuery\SourceQuery;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Stevebauman\Location\Facades\Location;
use function Symfony\Component\Uid\Factory\create;

class AddServerController extends Controller
{
    public $request;
    public $server_mode;

    public function __construct(Request $request){
        $this->request = $request;
        $this->server_mode = 'public'; //По умолчанию
    }

    public function add_server(){
        $Query = new SourceQuery();
        $ip = explode(':', request()->input('address'))[0];
        $port = explode(':', request()->input('address'))[1];
        $status = 0;
        $serverCheck = null;

        //Проверка на правильный ip:port или hostname:port
        if(!preg_match("/(?:[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,10})|(^(?![-.+])[a-z0-9-.+]+\:{1}[0-9]{1,7})/", request()->input('address'))){
            $status = 5;
        }else{
            try{
                $Query->Connect($ip, $port, 1, SourceQuery::SOURCE);
                //dd($Query);
                $server = [
                    'info_server' => $Query->GetInfo(),
                    'players' => $Query->GetPlayers(),
                    'ping' => $Query->Ping(),
                    'rules' => $Query->GetRules()
                ];

                //dd($server);

                if(!$server['info_server']){
                    $status = 3;
                }elseif($server['info_server']['AppID'] != 730){
                    $status = 6;
                }elseif($server['info_server'] !== false){
                    $serverCheck = Servers::where('ip', $ip)->where('port', $port)->get();
                    if(collect($serverCheck)->isNotEmpty()){
                        $status = 1;
                    }else{
                        if(!empty($server['players'])){
                            $players_list = collect($server['players'])->map(function ($player){
                                if($player['Name'] != '') return collect($player)->only('Name', 'Frags');
                                return null;
                            })->filter()->sortByDesc('Frags')->toArray();
                        }else{
                            $players_list = null;
                        }

                        Servers::create([
                            'name' => $server['info_server']['HostName'],
                            'map' => strpos($server['info_server']['Map'], '/') !== false ? substr($server['info_server']['Map'], strrpos($server['info_server']['Map'], '/') + 1) : $server['info_server']['Map'],
                            'game' => 'csgo',
                            'players' => $server['info_server']['Players'],
                            'maxplayers' => $server['info_server']['MaxPlayers'],
                            'bots' => $server['info_server']['Bots'],
                            'os' => $server['info_server']['Os'],
                            'version' => $server['info_server']['Version'],
                            'ip' => $ip,
                            'port' => $port,
                            'mode' => is_null(request()->input('game_mode')) ? 'public' : request()->input('game_mode'),
                            'country' => isset(Location::get($ip)->countryCode) ? Location::get($ip)->countryCode : 'Unknown',
                            'specport' => isset($server['info_server']['SpecPort']) ? $server['info_server']['SpecPort'] : NULL,
                            'password' => $server['info_server']['Password'] ? 1 : 0,
                            'status' => 'Online',
                            'add_server_time' => time(),
                            'last_update' => time(),
                            'players_list' => $players_list,
                        ]);
                    }
                }else{
                    $status = 3;
                }
            }catch(Exception $e) {
                $status = 2;
            }
        }

        SEOMeta::setTitle('Добавить сервер кс го')
            ->setDescription('Вы можете добавить игровой сервер в мониторинг серверов по cs go будь-то steam или no-steam. Вам нужно только вставить свой адрес и выбрать режим мода сервера ксго.')
            ->setKeywords('Сервер кс го добавить в список серверов, сервер пиратка добавить в мониторинг, свой сервер раскрутить бесплатно онлайн, поднять онлайн на сервере cs go');
        OpenGraph::setTitle('Добавить сервер кс го - CSGO-MS.com')
            ->setDescription('Вы можете добавить игровой сервер в мониторинг серверов по cs go будь-то steam или no-steam. Вам нужно только вставить свой адрес и выбрать режим мода сервера ксго.');

        $game_mode = GameMode::all();
        $servers = Servers::orderBy('id', 'desc')->take(25)->get();

        return view('pages.add_server', [
            'status' => $status, 'game_mode' => $game_mode,
            'server_address' => request()->input('address'), 'servers' => $servers
        ]);
    }

    public function getServerInfo(){
        if($this->request->method() === 'POST'){
            if(!is_null($this->request->input('address'))){
                $this->adress = trim($this->request->input('address'));
            }else{
                return abort(404);
            }
        }

        $status = 0;
        $servers = null;
        $game_mode = GameMode::all();

        //Проверка на правильный ip:port или hostname:port
        if(!preg_match("/(?:[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,10})|(^(?![-.+])[a-z0-9-.+]+\:{1}[0-9]{1,7})/", $this->adress)){
            $status = 5;
        }else{
            $server_ip = explode(':', $this->adress)[0];
            $server_port = explode(':', $this->adress)[1];

            /*$server = $this->client->get("https://monitoring-servers.ru/api?token=5bkKsSdXe7M89RS487bc&ip={$server_ip}&port={$server_port}")->getBody()->getContents();
            $server = json_decode($server, true);
            dd([$server_ip, $server_port]);*/

            //Проверяем в базе сервер
            if(Servers::where('ip', '=', $server_ip)->where('port', '=', $server_port)->get()->isEmpty()){
                //Получаем инфу о сервере
                $server = $this->client->get("https://monitoring-servers.ru/api?token=5bkKsSdXe7M89RS487bc&ip={$server_ip}&port={$server_port}")->getBody()->getContents();
                $server = json_decode($server, true);

                //Если все нормально, то добавляем сервер в базу
                if(!empty($server['info_server']) && !is_null($server) && $server['info_server']['AppID'] == 730){
                    //Получаем страну
                    if(isset(Location::get($server_ip)->countryCode)){
                        $country = Location::get($server_ip)->countryCode;
                    }else{
                        $country = 'Unknown';
                    }

                    //Проверяем мод
                    if(!is_null($this->request->input('game_mode'))){
                        $mode = $game_mode->whereIn('type', trim($this->request->input('game_mode')));
                        if($mode->isNotEmpty()){
                            $this->server_mode = $mode->first()->type;
                        }
                    }

                    try {
                        if(!empty($server['players'])){
                            $players_list = collect($server['players'])->map(function ($player){
                                if($player['Name'] != '') return collect($player)->only('Name', 'Frags');
                            })->filter()->sortByDesc('Frags')->toJson(JSON_UNESCAPED_UNICODE);
                        }else{
                            $players_list = null;
                        }

                        //Проверка карты на слеш (если из мастерской)
                        $map = strpos($server['info_server']['Map'], '/') !== false ? substr($server['info_server']['Map'], strrpos($server['info_server']['Map'], '/') + 1) : $server['info_server']['Map'];
                        DB::connection('servers')->table('servers')->insert([
                            'name' => $server['info_server']['HostName'],
                            'map' => $map,
                            'game' => $server['info_server']['ModDir'],
                            'players' => $server['info_server']['Players'],
                            'maxplayers' => $server['info_server']['MaxPlayers'],
                            'bots' => $server['info_server']['Bots'],
                            'os' => $server['info_server']['Os'],
                            'version' => $server['info_server']['Version'],
                            'ip' => $server_ip,
                            'port' => $server_port,
                            'specport' => isset($server['info_server']['SpecPort']) ? $server['info_server']['SpecPort'] : null,
                            'mode' => $this->server_mode,
                            'country' => $country,
                            'add_server_time' => Carbon::now()->timestamp,
                            'last_update' => Carbon::now()->timestamp,
                            'players_list' => $players_list,
                            'status' => 'Online'
                        ]);
                        $status = 1;
                    }catch (Exception $e){
                        $status = 2;
                    }
                }elseif(!$server['info_server']){
                    $status = 3;
                }elseif($server['info_server']['AppID'] != 730){
                    $status = 6;
                }else{
                    $status = 3;
                }
            }else{
                $status = 4;
            }
        }

        SEOMeta::setTitle('Добавить сервер кс го')
            ->setDescription('Вы можете добавить игровой сервер в мониторинг серверов по cs go будь-то steam или no-steam. Вам нужно только вставить свой адрес и выбрать режим мода сервера ксго.')
            ->setKeywords('Сервер кс го добавить в список серверов, сервер пиратка добавить в мониторинг, свой сервер раскрутить бесплатно онлайн, поднять онлайн на сервере cs go');
        OpenGraph::setTitle('Добавить сервер кс го - CSGO-MS.com')
            ->setDescription('Вы можете добавить игровой сервер в мониторинг серверов по cs go будь-то steam или no-steam. Вам нужно только вставить свой адрес и выбрать режим мода сервера ксго.');


        return view('pages.add_server', ['status' => $status, 'game_mode' => $game_mode, 'server_address' => $server_address]);
    }

    public function show(){
        $status = 0;
        $servers = Servers::orderBy('id', 'desc')->take(25)->get();
        $game_mode = GameMode::all();

        SEOMeta::setTitle('Добавить сервер кс го')
            ->setDescription('Вы можете добавить игровой сервер в мониторинг серверов по cs go будь-то steam или no-steam. Вам нужно только вставить свой адрес и выбрать режим мода сервера ксго.')
            ->setKeywords('Сервер кс го добавить в список серверов, сервер пиратка добавить в мониторинг, свой сервер раскрутить бесплатно онлайн, поднять онлайн на сервере cs go');
        OpenGraph::setTitle('Добавить сервер кс го - CSGO-MS.com')
            ->setDescription('Вы можете добавить игровой сервер в мониторинг серверов по cs go будь-то steam или no-steam. Вам нужно только вставить свой адрес и выбрать режим мода сервера ксго.');

        return view('pages.add_server', ['status' => $status, 'game_mode' => $game_mode, 'servers' => $servers]);
    }
}
