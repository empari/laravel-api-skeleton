<?php
namespace Skel\Units\Core\Http\Controllers;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Response;
use Empari\Support\Http\Controllers\Controller as BaseController;

/**
 * Class HomeController
 *
 * @resource Home
 * @package Skel\Units\Core\Http\Controllers
 */
class HomeController extends BaseController
{
    /**
     * Get a message for your inpiration
     *
     * @return string
     */
    public function index()
    {
        return Inspiring::quote();
    }

    /**
     * Get all routes
     *
     * @return void
     */
    public function routes()
    {
        \Artisan::call('route:list');
        $msg = '<pre>' . \Artisan::output() . '</pre>';

        return response()->make($msg, Response::HTTP_OK);
    }
}
