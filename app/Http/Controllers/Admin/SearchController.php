<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            $ip = $port = null;
            $servers = collect();
            if(preg_match("/(?:[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{5})|(^(?![-.+])[a-z0-9-.+]+\:{1}[0-9]{1,7})/", $slug)){
                $ip = explode(':', $slug)[0];
                $port = explode(':', $slug)[1];
                $servers = Servers::where(['ip' => $ip, 'port' => $port])->get();
            }else{
                $servers = Servers::where('name', 'like', '%'.$slug.'%')
                    ->orWhere('ip', 'like', '%'.$slug.'%')->orWhere('port', 'like', '%'.$slug.'%')->get();
            }


            //dd($servers);
            if(!$servers){
                $servers = null;
            }
        }else{
            return abort(404);
        }

        return view('admin.pages.search', ['servers' => $servers, 'slug' => $slug]);
    }
}
