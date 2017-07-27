<?php
namespace Skel\Units\Core\Providers;

use Illuminate\Support\ServiceProvider;

class OnlyEnvLocalServiceProvider extends ServiceProvider
{
    protected $services = [
        \Mpociot\ApiDoc\ApiDocGeneratorServiceProvider::class,
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // only Environment local
        if (config('app.env') == 'local') {
            foreach ($this->services as $serviceClass) {
                $this->registerClass($serviceClass);
            }
        }
    }

    /**
     * Register a Class into Service Provider
     *
     * @param string|null $class
     */
    private function registerClass(string $class = null)
    {
        if(class_exists($class)){
            $this->app->register($class);
        }
    }
}