<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Debugbar::enable();

Route::get('/', [App\Http\Controllers\HomeController::class, 'show'])->name('home');

Route::get('/add_server.html', [App\Http\Controllers\AddServerController::class, 'show'])->name('add_server');
Route::post('/add_server.html', [App\Http\Controllers\AddServerController::class, 'add_server'])->name('add_server_post');

Route::get('/podobrat_server.html', [App\Http\Controllers\PodobratServerController::class, 'show'])->name('podobrat_server');

Route::get('/contacts.html', [App\Http\Controllers\ContactsController::class, 'show'])->name('contacts');
Route::post('/contacts.html', [App\Http\Controllers\ContactsController::class, 'newLetter'])->name('contacts_post');

//Route::get('/rules.html', [App\Http\Controllers\RulesController::class, 'show'])->name('rules');
Route::get('/faq.html', [App\Http\Controllers\FAQController::class, 'show'])->name('faq');

Route::get('/sitemap.html', [App\Http\Controllers\SiteMapController::class, 'show'])->name('sitemap');
Route::get('/services.html', [App\Http\Controllers\ServicesController::class, 'show'])->name('services');
Route::post('/services.html', [App\Http\Controllers\ServicesController::class, 'checkServices'])->name('services_check');

Route::get('/search', [App\Http\Controllers\SearchController::class, 'show'])->name('search');

Route::get('/servers', [App\Http\Controllers\ServersController::class, 'show'])->name('servers');
Route::get('/servers/{slug:}.html', [App\Http\Controllers\ServerInfoController::class, 'show'])->where('slug', '(?:[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,10})|(^(?![-.+])[a-z0-9-.+]+\:{1}[0-9]{1,7})')->name('server_info');

//Фильтры по моду, карте и стране
Route::get('/mod-{slug}.html', [App\Http\Controllers\FilterController::class, 'mod'])->where('slug', '^[a-z0-9_]+')->name('filter_mod');
Route::get('/location-{slug}.html', [App\Http\Controllers\FilterController::class, 'location'])->where('slug', '^[A-Z]+')->name('filter_location');
Route::get('/map-{slug}.html', [App\Http\Controllers\FilterController::class, 'map'])->where('slug', '^[A-Za-z0-9_\-\$\[\].+]+$')->name('filter_map');

Route::get('/mod-{slug}/location-{slug2}.html', [App\Http\Controllers\FilterController::class, 'mod_location'])->name('filter_mod_location');
Route::get('/mod-{slug}/map-{slug2}.html', [App\Http\Controllers\FilterController::class, 'mod_map'])->where('slug2', '^[A-Za-z0-9_\-\$\[\].+]+$')->name('filter_mod_map');


