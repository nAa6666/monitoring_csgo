<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public $request = null;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function show(){
        return view('admin.settings.services');
    }
}
