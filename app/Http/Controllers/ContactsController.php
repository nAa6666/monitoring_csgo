<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function newLetter(){
        //Сделать проверку на капчу
        //dd($this->request->input());

        SEOMeta::setTitle('Обратная связь')
            ->setDescription('Возникли проблемы в мониторинге с сервером по кс го? Напишите нам подробнее что случилось.')
            ->setKeywords('проблемы ксго, помощь по серверу cs go, help cs go, контакты кс го, написать в тп ксго, сломался сервер cs go.');
        OpenGraph::setTitle('Обратная связь - CSGO-MS.com')
            ->setDescription('Возникли проблемы с сервером кс го?');

        return view('pages.contacts');
    }

    public function show(){
        SEOMeta::setTitle('Обратная связь')
            ->setDescription('Возникли проблемы в мониторинге с сервером по кс го? Напишите нам подробнее что случилось.')
            ->setKeywords('проблемы ксго, помощь по серверу cs go, help cs go, контакты кс го, написать в тп ксго, сломался сервер cs go.');
        OpenGraph::setTitle('Обратная связь - CSGO-MS.com')
            ->setDescription('Возникли проблемы с сервером кс го?');

        return view('pages.contacts');
    }
}
