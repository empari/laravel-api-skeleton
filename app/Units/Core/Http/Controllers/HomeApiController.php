<?php
namespace Skel\Units\Core\Http\Controllers;

use Empari\Support\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;

/**
 * Class HomeApiController
 *
 * @resource Home
 * @package Skel\Units\Core\Http\Controllers
 */
class HomeApiController extends Controller
{
    /**
     * Get a message for your inpiration
     *
     * @return array
     */
    public function index()
    {
        return $this->prepareResponse([
            'inspire' => Inspiring::quote()
        ]);
    }

    /**
     * Get all routes
     *
     * @return json
     */
    public function routes()
    {
        return $this->prepareResponse(
            app('router')
            ->getRoutes() // return RouteColletion
            ->getRoutes() // return Routes in RouteColletion
        );
    }
}