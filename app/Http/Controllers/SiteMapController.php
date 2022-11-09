<?php

namespace App\Http\Controllers;

use App\Models\GameMode;
use App\Models\LocationServer;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class SiteMapController extends Controller
{
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function show(){
        $game_mode = GameMode::all();
        $location_server = LocationServer::all()->sortByDesc('ord');

        SEOMeta::setTitle('Карта сайта')
            ->setDescription('Мониторинг серверов по кс го "Карта сайта", с карты сайта можно перейти в любую ветку нашего мониторинга серверов cs go.')
            ->setKeywords('моды по ксго, карты по csgo, страны/локации контр страйк, ссылка на сервера по кс го, список серверов по кс го.');
        OpenGraph::setTitle('Карта сайта - CSGO-MS.com')
            ->setDescription('Мониторинг серверов по кс го "Карта сайта", с карты сайта можно перейти в любую ветку нашего мониторинга серверов cs go.');
        return view('pages.site_map', ['game_mode' => $game_mode, 'location_server' => $location_server]);
    }
}
