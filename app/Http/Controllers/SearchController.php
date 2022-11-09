<?php

namespace App\Http\Controllers;

use App\Models\Servers;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function show(){
        if(!empty($this->request->input('q'))){
            $slug = $this->request->input('q');
            //Проверка на правильный ip:port или hostname:port
            if(!preg_match("/(?:[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{5})|(^(?![-.+])[a-z0-9-.+]+\:{1}[0-9]{1,7})/", $slug)){
                return abort(404);
            }else{
                $server_ip = explode(':', $slug)[0];
                $server_port = explode(':', $slug)[1];
            }

            $server = Servers::where(['ip' => $server_ip, 'port' => $server_port])->get()->first();
            if(!$server){
                $server = null;
            }
        }else{
            return abort(404);
        }

        return view('pages.search', ['server' => $server, 'search_ip_port' => $slug]);
    }
}
