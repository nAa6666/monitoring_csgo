<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function index(){
        $variables = [
            'version_mysql' => DB::select(DB::raw("select version() as version")),
            'size_db' => explode('.', collect(
                DB::select("SELECT Round(Sum(data_length + index_length) / 1024 / 1024, 3) AS size_db FROM information_schema.TABLES WHERE table_schema = 'csgoms'")
            )->first()->size_db),
            'data_srv' => date("H:i - d.m.Y", time()),
            'version_os' => explode(' ', php_uname())[0],
        ];
        //dd($variables);
        return view('admin.pages.home', ['variables' => $variables]);
    }
}
