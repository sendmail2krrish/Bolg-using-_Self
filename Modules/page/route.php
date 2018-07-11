<?php
use _Self\Route;
$route = new Route();

$route->get('/', 'PageController@homepage');
$route->get('/about', 'PageController@aboutpage');
$route->get('/posts', 'PageController@posts');
$route->get('/post/:post', 'PageController@post');
?>