<?php
namespace Skel\Units\Core\Providers;

use Skel\Units\Core\Http\Routes\HomeRoutes;
use Empari\Support\Http\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Skel\Units\Core\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->registerRouteClass(HomeRoutes::class);
    }
}
