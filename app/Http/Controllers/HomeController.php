<?php

namespace App\Http\Controllers;

use App\Models\Servers;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function show(){
        $servers = Servers::skip(0)->take(100)->get();

        SEOMeta::setTitle('Мониторинг серверов');
        return view('pages.index', ['servers' => $servers]);
    }
}
