<?php

namespace App\Http\Controllers;

use App\Models\GameMode;
use App\Models\LocationServer;
use App\Models\Servers;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public $request;
    public $page;
    public $servers_item = 100;

    public function __construct(Request $request){
        $this->request = $request;
        $this->page = (int)$request->page ?: 1;
    }

    //Фильтр по моду
    public function mod($slug){
        $game_mode = GameMode::all()->whereIn('type', $slug);
        if($game_mode->isEmpty()){
            return abort(404);
        }

        $servers = Servers::where('mode', $game_mode->first()->type)->simplePaginate($this->servers_item);

        $pages = (int)ceil(Servers::where('mode', $game_mode->first()->type)->count() / $this->servers_item) + 1;
        $keyID = $servers->currentPage() > 1 ? ($servers->currentPage() - 1) * $this->servers_item : 0;
        $seo_description = $game_mode->first()->seo_description;

        SEOMeta::setTitle($game_mode->first()->title)
            ->setDescription($game_mode->first()->description)
            ->setKeywords($game_mode->first()->keywords);
        OpenGraph::setTitle($game_mode->first()->title.' - CSGO-MS.com')
            ->setDescription($game_mode->first()->description)->addImage(asset(sprintf('images/mod/%s', $game_mode->first()->image_og)));

        $title_h1 = $game_mode->first()->type;
        return view('pages.filters', [
                'servers' => $servers,
                'game_mode' => $game_mode->first(),
                'title_h1' => $title_h1,
                'seo_description' => $seo_description,
                'pages' => $pages,
                'keyID' => $keyID,
                'slug' => $slug,
            ]
        );
    }

    //Фильтр по стране
    public function location($slug){
        $location = LocationServer::where('code', $slug)->get();
        if($location->isEmpty()){
            return abort(404);
        }

        $title_h1 = $location->first()->location_name.' ('.$location->first()->code.')';
        $servers = Servers::where('country', $location->first()->code)->simplePaginate($this->servers_item);

        $pages = (int)ceil(Servers::where('country', $location->first()->code)->count() / $this->servers_item) + 1;
        $keyID = $servers->currentPage() > 1 ? ($servers->currentPage() - 1) * $this->servers_item : 0;

        $location->first()->description = strlen($location->first()->description) > 0 ? $location->first()->description : "Сервера кс го по стране {$location->first()->location_name}. Играть на серверах кс го {$location->first()->location_name} ({$location->first()->code}) без стима онлайн. Список серверов cs go с локацией {$location->first()->location_name}.";

        SEOMeta::setTitle($location->first()->title)
            ->setDescription($location->first()->description)
            ->setKeywords("Сервера кс го на стране {$location->first()->title}, cs go location {$location->first()->title}, мониторинг ксго {$location->first()->title}");
        OpenGraph::setTitle("{$location->first()->title} - CSGO-MS.com")
            ->setDescription($location->first()->description);

        return view('pages.filters', [
                'servers' => $servers,
                'title_h1' => $title_h1,
                'location' => $location->first(),
                'pages' => $pages,
                'keyID' => $keyID,
                'slug' => $slug,
            ]
        );
    }

    //Фильтр по карте
    public function map($slug){
        $servers = Servers::where('map', $slug)->simplePaginate($this->servers_item);
        $pages = null;
        $keyID = null;
        $title_h1 = $slug;

        if(collect($servers->items())->isNotEmpty()){
            $pages = (int)ceil(Servers::where('map', $slug)->count() / $this->servers_item) + 1;
            $keyID = $servers->currentPage() > 1 ? ($servers->currentPage() - 1) * $this->servers_item : 0;
        }

        SEOMeta::setTitle("Мониторинг серверов кс го {$slug}")
            ->setDescription("Список серверов по кс го с картой {$slug}. Играть в cs go на карте {$slug} онлайн с друзьями и новыми знакомыми.")
            ->setKeywords("Сервера с картой {$slug} cs go, играть на карте {$slug}, кс го карта {$slug}");
        OpenGraph::setTitle("Мониторинг серверов кс го {$slug} - CSGO-MS.com")
            ->setDescription("Список серверов по кс го с картой {$slug}. Играть в cs go на карте {$slug} онлайн с друзьями и новыми знакомыми.");

        return view('pages.filters', [
                'servers' => $servers,
                'title_h1' => $title_h1,
                'map' => $slug,
                'pages' => $pages,
                'keyID' => $keyID,
                'slug' => $slug,
            ]
        );
    }

    //Фильтр по моду и стране
    public function mod_location($slug, $slug2){
        $game_mode = GameMode::all()->whereIn('type', $slug);
        if($game_mode->isEmpty()){
            return abort(404);
        }

        $location = LocationServer::where('code', $slug2)->get();
        if($location->isEmpty()){
            return abort(404);
        }

        $title_h1 = mb_strtolower($game_mode->first()->type.' '.$location->first()->location_name);
        $servers = Servers::where('mode', $game_mode->first()->type)->where('country', $location->first()->code)->simplePaginate($this->servers_item);
        $pages = (int)ceil(Servers::where('mode', $game_mode->first()->type)->where('country', $location->first()->code)->count() / $this->servers_item) + 1;
        $keyID = $servers->currentPage() > 1 ? ($servers->currentPage() - 1) * $this->servers_item : 0;

        SEOMeta::setTitle("Мониторинг серверов кс го {$title_h1}")
            ->setDescription("Список серверов cs go {$title_h1}, играть только на локации {$location->first()->location_name} ({$location->first()->code}) в кс го онлайн. Сервера контр страйк глобал оффенсив {$game_mode->first()->name2} со страной {$location->first()->location_name}.")
            ->setKeywords("Серваки кс го {$game_mode->first()->name2} ({$location->first()->code}), сервера csgo {$game_mode->first()->type} {$location->first()->location_name}, servers cs go {$game_mode->first()->type} {$location->first()->location_name}.");
        OpenGraph::setTitle("Мониторинг серверов кс го {$title_h1} - CSGO-MS.com")
            ->setDescription("Список серверов cs go {$title_h1}, играть только на локации {$location->first()->location_name} ({$location->first()->code}) в кс го онлайн. Сервера контр страйк глобал оффенсив {$game_mode->first()->name2} со страной {$location->first()->location_name}.");

        return view('pages.filters', [
                'servers' => $servers,
                'title_h1' => $title_h1.mb_strtolower(' ('.$location->first()->code.')'),
                'location' => $location->first(),
                'pages' => $pages,
                'keyID' => $keyID,
                'slug' => $slug,
                'game_mode' => $game_mode->first(),
            ]
        );
    }

    //Фильтр по моду и карте
    public function mod_map($slug, $slug2){
        if($slug == 'dust2only' && $slug2 == 'de_dust2'){
            return abort(404);
        }

        $game_mode = GameMode::all()->whereIn('type', $slug);
        if($game_mode->isEmpty()){
            return abort(404);
        }

        $servers = Servers::where('mode', $game_mode->first()->type)->where('map', $slug2)->simplePaginate($this->servers_item);
        $pages = null;
        $keyID = null;
        $title_h1 = $slug.' '.$slug2;

        if(collect($servers->items())->isNotEmpty()){
            $pages = (int)ceil(Servers::where('mode', $game_mode->first()->type)->where('map', $slug2)->count() / $this->servers_item) + 1;
            $keyID = $servers->currentPage() > 1 ? ($servers->currentPage() - 1) * $this->servers_item : 0;
        }

        SEOMeta::setTitle("Мониторинг серверов кс го {$slug} {$slug2}")
            ->setDescription("Список серверов CS:GO {$game_mode->first()->name} с картой {$slug2}. Играть на серверах по кс го {$game_mode->first()->name2} с картой {$slug2} онлайн как со стим версии или на пиратке.")
            ->setKeywords("Сервера кс го {$slug} {$slug2}, мониторинг csgo {$slug} {$slug2}, servers {$slug} {$slug2}, серваки по ксго {$game_mode->first()->name2} {$slug2}");
        OpenGraph::setTitle("Мониторинг серверов кс го {$slug} {$slug2} - CSGO-MS.com")
            ->setDescription("Список серверов CS:GO {$game_mode->first()->name} с картой {$slug2}. Играть на серверах по кс го {$game_mode->first()->name2} с картой {$slug2} онлайн как со стим версии или на пиратке.");

        return view('pages.filters', [
                'servers' => $servers,
                'title_h1' => $title_h1,
                'map' => $slug2,
                'pages' => $pages,
                'keyID' => $keyID,
                'slug' => $slug,
                'game_mode' => $game_mode->first(),
            ]
        );
    }

    public function show($servers){
        return view('pages.filters', ['servers' => $servers]);
    }
}
