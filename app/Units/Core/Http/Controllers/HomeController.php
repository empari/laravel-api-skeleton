<?php
namespace Skel\Units\Core\Http\Controllers;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Response;
use Empari\Support\Http\Controllers\Controller as BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        return Inspiring::quote();
    }

    public function routes()
    {
        \Artisan::call('route:list');
        $msg = '<pre>' . \Artisan::output() . '</pre>';

        return response()->make($msg, Response::HTTP_OK);
    }
}
