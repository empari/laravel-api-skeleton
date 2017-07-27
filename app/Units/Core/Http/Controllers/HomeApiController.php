<?php
namespace Skel\Units\Core\Http\Controllers;

use Empari\Support\Http\Controllers\Controller;
use Illuminate\Foundation\Inspiring;

class HomeApiController extends Controller
{
    public function index()
    {
        return $this->prepareResponse([
            'inspire' => Inspiring::quote()
        ]);
    }

    public function routes()
    {
        return $this->prepareResponse(
            app('router')
            ->getRoutes() // return RouteColletion
            ->getRoutes() // return Routes in RouteColletion
        );
    }
}