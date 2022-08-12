<?php

namespace Wuxuejian\DcatVr;

use Dcat\Admin\Extend\ServiceProvider;
use Wuxuejian\DcatVr\Setting;

class DcatVrServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
    ];
	protected $css = [
		'css/index.css',
	];

	protected $menu = [
	    [
	        'title' => 'VR管理',
            'uri' => '',
        ],
        [
            'parent' => 'VR管理',
            'title' => '活动列表',
            'uri' => 'dcat-vr/vrs'
        ],
        [
            'parent' => 'VR管理',
            'title' => '场景列表',
            'uri' => 'dcat-vr/vrscenes'
        ]
    ];

	public function register()
	{
		//
	}

	public function init()
	{
		parent::init();

		//
        $a = new DcatVrFrontendServiceProvider(app());
        $a->init();
	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
