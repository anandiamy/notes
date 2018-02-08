<?php
$router = new \Bramus\Router\Router();
$router->setNamespace('App\Controllers');

$router->get('/', 'PageController@home');
$router->get('/login/', 'PageController@getLogin');
$router->post('/login', 'PageController@postLogin');

$router->get('/search', 'SearchController@q');
$router->post('/search', 'SearchController@search');

$router->get('/(.*)', 'NoteController@getNote');
$router->post('/(.*)', 'NoteController@postNote');

$router->run();

