<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GameMode;
use App\Models\Servers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\SourceQuery\SourceQuery;
use Stevebauman\Location\Facades\Location;

class ServersController extends Controller
{
    public $page;
    public $servers_item = 50;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $servers = Servers::simplePaginate($this->servers_item);
        if(collect($servers->items())->isEmpty()){
            return abort(404);
        }

        $pages = (int)ceil(Servers::count() / $this->servers_item) + 1;
        $keyID = $servers->currentPage() > 1 ? ($servers->currentPage() - 1) * $this->servers_item : 0;

        return view('admin.servers.index', ['servers' => $servers, 'pages' => $pages, 'keyID' => $keyID]);
    }

    public function new_servers()
    {
        $servers = Servers::orderBy('id', 'desc')->skip(0)->limit(50)->get();
        return view('admin.servers.new_servers', ['servers' => $servers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $game_mode = GameMode::all();
        return view('admin.servers.add', ['game_mode' => $game_mode, 'serverCheck' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $Query = new SourceQuery();
        $ip = explode(':', request()->input('adress'))[0];
        $port = explode(':', request()->input('adress'))[1];
        $status = 0;
        $serverCheck = null;
        try{
            $Query->Connect($ip, $port, 1, SourceQuery::SOURCE);
            $server = [
                'info_server' => $Query->GetInfo(),
                'players' => $Query->GetPlayers(),
                'ping' => $Query->Ping(),
                'rules' => $Query->GetRules()
            ];

            if($server['info_server'] !== false){
                $serverCheck = Servers::where('ip', $ip)->where('port', $port)->get();
                if(collect($serverCheck)->isNotEmpty()){
                    $status = 1;
                    $serverCheck = $serverCheck->first();
                }else{
                    $serverAdd = new Servers();
                    $serverAdd->name = $server['info_server']['HostName'];
                    $serverAdd->map = strpos($server['info_server']['Map'], '/') !== false ? substr($server['info_server']['Map'], strrpos($server['info_server']['Map'], '/') + 1) : $server['info_server']['Map'];
                    $serverAdd->game = 'csgo';
                    $serverAdd->players = $server['info_server']['Players'];
                    $serverAdd->maxplayers = $server['info_server']['MaxPlayers'];
                    $serverAdd->bots = $server['info_server']['Bots'];
                    $serverAdd->os = $server['info_server']['Os'];
                    $serverAdd->version = $server['info_server']['Version'];
                    $serverAdd->ip = $ip;
                    $serverAdd->port = $port;
                    $serverAdd->mode = is_null(request()->input('game_mode')) ? 'public' : request()->input('game_mode');
                    $serverAdd->country = isset(Location::get($ip)->countryCode) ? Location::get($ip)->countryCode : 'Unknown';
                    $serverAdd->specport = isset($server['info_server']['SpecPort']) ? $server['info_server']['SpecPort'] : NULL;
                    $serverAdd->password = $server['info_server']['Password'] ? 1 : 0;
                    $serverAdd->status = 'Online';
                    $serverAdd->add_server_time = time();
                    $serverAdd->last_update = time();
                    $serverAdd->save();

                    $serverCheck->id = $serverAdd->id;
                }
            }else{
                $status = 2;
            }

        }catch(Exception $e) {
            return [];
        }
        $game_mode = GameMode::all();
        return view('admin.servers.add', ['game_mode' => $game_mode, 'status' => $status, 'serverCheck' => $serverCheck]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function show(Servers $server)
    {
        return view('admin.servers.show', compact('server'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function edit(Servers $servers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servers $servers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servers  $servers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servers $servers)
    {
        return 123;
    }
}
