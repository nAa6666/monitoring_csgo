<?php

namespace App\Http\Controllers;

use App\Models\Servers;
use App\Models\ServicesSettings;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public $request;
    public $status;
    public $server_ip_port;
    private $services_type = ['top', 'vip', 'allocations'];
    private $pay_type = ['wb', 'fk'];
    private $current_services;
    private $price;
    private $form;

    public function __construct(Request $request){
        $this->request = $request;
        $this->status = 0;
        $this->price = 0;
    }

    public function checkServices(){
        //Проверяем на валидную форму
        if(!empty($this->request->input('services_form'))){
            $services_form = trim($this->request->input('services_form')); //Смотрим с какой формы пришло
            if(in_array($services_form, $this->services_type)){ //Делаю проверку на подмену формы
                $this->form = $this->request->input(); //Получаем все с формы
                //Делаем проверку на иды этой услуги
                $this->current_services = collect($this->getServices()[$services_form])->whereIn('services_id', $this->form['services_id']);
                if($this->current_services->isNotEmpty()){
                    $this->price = $this->current_services->first()['price']; //Получаем цену за услугу
                }else{
                    return abort(404);
                }
            }else{
                return abort(404);
            }
        }else{
            return abort(404);
        }

        //ТОП
        if($services_form === 'top'){
            $this->form_order_top();
        }
        //VIP
        if($services_form === 'vip'){
            $this->form_order_vip();
        }
        //Выделения
        if($services_form === 'allocations'){
            $this->form_order_allocations();
        }

        $this->seometaF();
        return view('pages.services', ['status' => $this->status]);
    }

    //Покупка топа
    public function form_order_top(){
        //Проверяем сервер есть ли в базе
        if($this->checkServer()){
            $this->checkPayType();
        }
    }

    //Покупка випа
    public function form_order_vip(){
        dump('form_order_top');
    }

    //Покупка выдиление
    public function form_order_allocations(){
        dump('form_order_top');
    }

    //Проверяем сервер в базе
    public function checkServer(){
        if(!empty($this->request->input('server'))){
            $this->server_ip_port = $this->request->input('server');
            if(!preg_match("/(?:[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,10})|(^(?![-.+])[a-z0-9-.+]+\:{1}[0-9]{1,7})/", $this->server_ip_port)){
                $this->status = 1; //Некорректный ip:port или hostname:port
            }else{
                $server_ip = explode(':', $this->server_ip_port)[0];
                $server_port = explode(':', $this->server_ip_port)[1];
                if(Servers::where('ip', '=', $server_ip)->where('port', '=', $server_port)->get()->isNotEmpty()){
                    return true;
                }else{
                    $this->status = 2; //Сервер не найден в мониторинге!
                }
            }
        }else{
            return abort(404);
        }
    }

    public function checkPayType(){
        dd([$this->current_services, $this->form]); //Надо сделать (обьеденить сервер ип и порт и усоугу и тип оплаты)
    }

    //Оплаата по WebMoney (Merchant)
    public function webmoney(){

    }

    //Оплаата по Free-Kassa
    public function freekassa(){

    }

    public function show(){
        $servers = Servers::orderBy('id', 'desc')->take(25)->get();
        $this->seometaF();
        return view('pages.services', ['status' => $this->status, 'servers' => $servers, 'services' => $this->getServices()]);
    }

    public function getServices(){
       return ServicesSettings::all()->mapToGroups(function ($service) {
           return [$service['services_type'] => $service];
       })->toArray();
    }

    public function seometaF(){
        SEOMeta::setTitle('Услуги')->setDescription('Раскрутка сервера кс го, можно заказать ТОП и Баллы для сервера cs go. Поднять сервер в топ бесплатно. Буст сервера ксго тоже доступен.')
            ->setKeywords('Буст раскрутка сервера кс го, баллы для сервера csgo, vip cs go сервер, поднять в топ сервер по кс го, ');
        OpenGraph::setTitle('Услуги - CSGO-MS.com')
            ->setDescription('Бесплатная буст раскрутка по кс го, поднятие сервера в топ cs go.');
    }
}
