<?php

namespace App\Http\Controllers;

use App\Models\GameMode;
use App\Models\LocationServer;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class PodobratServerController extends Controller
{
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function show(){
        $game_mode = GameMode::all();
        $location_server = LocationServer::all()->sortByDesc('ord');

        SEOMeta::setTitle('Подобрать сервер')
            ->setDescription('В мониторинге кс го большое количество мод режимов, локаций(страны) и карт, вы можите подобрать себе сервер cs go на любой вкус. Подобрать сервер с другом.')
            ->setKeywords('КС ГО мод режимы, подобрать кс го сервер, csgo с картой, подборка сервера с другом, выбрать сервер по cs go онлайн, кс го пиратка или без стима, контр страйк го искать сервера.');
        OpenGraph::setTitle('Подобрать сервер')
            ->setDescription('Большое количество мод режимов, локаций(страны) и карт, вы можите подобрать себе сервер кс го на любой вкус.');

        return view('pages.podobrat_server', ['game_mode' => $game_mode, 'location_server' => $location_server]);
    }
}
