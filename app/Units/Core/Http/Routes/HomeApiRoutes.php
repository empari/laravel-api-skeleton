<?php
namespace Skel\Units\Core\Http\Routes;


use Empari\Support\Http\Routing\RouteFileApi;

class HomeApiRoutes extends RouteFileApi
{
    /**
     * Define Routes
     */
    protected function routes()
    {
        $this->router->get('/', 'HomeApiController@index')->name('api.index');
        $this->router->get('/routes', 'HomeApiController@routes')->name('api.routes');
    }
}