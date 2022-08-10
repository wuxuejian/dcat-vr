<?php

namespace Wuxuejian\DcatVr;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use Dcat\Admin\Admin;
use RuntimeException;

class DcatVrFrontendServiceProvider extends LaravelServiceProvider
{
	protected $js = [
        //'js/index.js',
    ];
	protected $css = [
		//'css/index.css',
	];
    private $path;

    public function register()
	{
		//
	}

	public function init()
	{
        $path = $this->path('src/Http/routes-frontend.php');
        $this->registerRoutes($path);


	}

	public function boot() {
        $this->init();
    }

    protected function registerRoutes($path)
    {
        Route::group($this->routeConfiguration(), function () use($path) {
            $this->loadRoutesFrom($path);
        });
    }

    protected function routeConfiguration()
    {//admin.route.frontend_prefix
        return [
            'prefix' => 'api/'.config('admin.route.vr.prefix','vrapi'),
            'middleware' => config('admin.route.vr.middleware',['api']),
        ];
    }



    /**
     * 获取扩展包路径.
     *
     * @param  string  $path
     * @return string
     *
     * @throws \ReflectionException
     */
    public function path(?string $path = null)
    {
        if (! $this->path) {
            $this->path = realpath(dirname((new \ReflectionClass(static::class))->getFileName()).'/..');

            if (! is_dir($this->path)) {
                throw new RuntimeException("The {$this->path} is not a directory.");
            }
        }

        $path = ltrim($path, '/');

        return $path ? $this->path.'/'.$path : $this->path;
    }
}
