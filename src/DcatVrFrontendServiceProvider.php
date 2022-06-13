<?php

namespace Wuxuejian\DcatVr;

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
		//parent::init();


        $path = $this->path('src/Http/routes-frontend.php');
        $this->registerRoutes($path);

		//$this->loadRoutesFrom($path);
		//

	}

	public function boot() {
        $this->init();
    }
	public function settingForm()
	{
		return new Setting($this);
	}



    /**
     * 注册路由.
     *
     * @param $callback
     */
    public function registerRoutes($callback)
    {
        Admin::app()->routes(function ($router) use ($callback) {
            $router->group([
                'prefix'     => config('admin.route.frontend_prefix',"vrx"),
                //'middleware' => config('admin.route.frontend_middleware'),
            ], $callback);
        });
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
