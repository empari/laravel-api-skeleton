<?php

namespace Skel\Units\Core\Http\Routes;


use Empari\Support\Http\Routing\RouteFileWeb;

class HomeRoutes extends RouteFileWeb
{
    /**
     * Define Routes
     */
    protected function routes()
    {
        $this->router->get('/', 'HomeController@index')->name('home.index');
        $this->router->get('/routes', 'HomeController@routes')->name('home.routes');
    }
}