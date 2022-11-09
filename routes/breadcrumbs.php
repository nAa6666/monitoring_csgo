<?php

// Home
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Главная', route('home'));
});

Breadcrumbs::for('add_server', function ($trail) {
    $trail->parent('home');
    $trail->push('Добавить сервер', route('add_server'));
});

Breadcrumbs::for('podobrat_server', function ($trail) {
    $trail->parent('home');
    $trail->push('Подобрать сервер', route('podobrat_server'));
});

Breadcrumbs::for('contacts', function ($trail) {
    $trail->parent('home');
    $trail->push('Обратная связь', route('contacts'));
});

Breadcrumbs::for('sitemap', function ($trail) {
    $trail->parent('home');
    $trail->push('Карта сайта', route('sitemap'));
});

Breadcrumbs::for('search', function ($trail) {
    $trail->parent('home');
    $trail->push('Поиск сервера', route('search'));
});

Breadcrumbs::for('servers', function ($trail) {
    $trail->parent('home');
    $trail->push('Сервера', route('servers'));
});

Breadcrumbs::for('server_info', function ($trail, $slug) {
    $trail->parent('servers');
    $trail->push($slug, route('server_info', $slug));
});

Breadcrumbs::for('services', function ($trail) {
    $trail->parent('home');
    $trail->push('Услуги', route('services'));
});

Breadcrumbs::for('faq', function ($trail) {
    $trail->parent('home');
    $trail->push('FAQ', route('faq'));
});

Breadcrumbs::for('filter_mod', function ($trail, $game_mode) {
    $trail->parent('servers');
    $trail->push($game_mode->name, route('filter_mod', $game_mode->type));
});

Breadcrumbs::for('filter_location', function ($trail, $location) {
    $trail->parent('servers');
    $trail->push($location->location_name, route('filter_location', $location->code));
});

Breadcrumbs::for('filter_map', function ($trail, $map) {
    $trail->parent('servers');
    $trail->push($map, route('filter_map', $map));
});

Breadcrumbs::for('filter_mod_location', function ($trail, $game_mode, $location) {
    $trail->parent('filter_mod', $game_mode);
    $trail->push($location->location_name, route('filter_mod_location', ['slug' => $game_mode->type, 'slug2' => $location->code]));
});

Breadcrumbs::for('filter_mod_map', function ($trail, $game_mode, $map) {
    $trail->parent('filter_mod', $game_mode);
    $trail->push($map, route('filter_mod_map', ['slug' => $game_mode->type, 'slug2' => $map]));
});
