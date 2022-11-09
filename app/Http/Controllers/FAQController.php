<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function show(){
        SEOMeta::setTitle('FAQ')
            ->setDescription('Вопросы и ответы по мониторингу и вашего игрового сервера. Здесь вы можете найти ответы на часто задаваемые вопросы о нашей системы.')
            ->setKeywords('faq мониторинг, помощь по мониторингу, кс го помощь, help cs go info, csgo помощь, проблемы с сервером кс го.');
        OpenGraph::setTitle('FAQ')
            ->setDescription('FAQ по игровому серверу CS:GO.');

        return view('pages.faq');
    }
}
