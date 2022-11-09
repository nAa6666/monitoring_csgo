<?php

namespace App\Http\Controllers;

use App\Models\Servers;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ServersController extends Controller
{
    public $request;
    public $page;
    public $servers_item = 100;

    public function __construct(Request $request){
        $this->request = $request;
        $this->page = (int)$request->page ?: 1;
    }

    public function show(){
        $servers = Servers::simplePaginate($this->servers_item);
        if(collect($servers->items())->isEmpty()){
            return abort(404);
        }

        $pages = (int)ceil(Servers::all()->count() / $this->servers_item) + 1;
        $keyID = $servers->currentPage() > 1 ? ($servers->currentPage() - 1) * $this->servers_item : 0;
        //dd($keyID);

        SEOMeta::setTitle('Весь список серверов')
            ->setDescription('Сервер-лист по cs go, можно найти сервер с любым модом, картой и локацией. База серверов очень большая.')
            ->setKeywords('КСГО все сервера, servers csgo, список серверов пиратка по кс го, csgo online all servers steam and no-steam');
        OpenGraph::setTitle('Весь список серверов - CSGO-MS.com')
            ->setDescription('Сервер-лист по cs go, можно найти сервер с любым модом, картой и локацией. База серверов очень большая.');

        return view('pages.servers', ['servers' => $servers, 'pages' => $pages, 'keyID' => $keyID]);
    }
}
