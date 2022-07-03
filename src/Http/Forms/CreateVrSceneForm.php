<?php

namespace Wuxuejian\DcatVr\Http\Forms;

use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;
use Wuxuejian\DcatVr\DcatVrServiceProvider;
use Wuxuejian\DcatVr\Models\Vr;
use Wuxuejian\DcatVr\Models\VrScene;

class CreateVrSceneForm extends Form implements LazyRenderable
{
    use LazyWidget;
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        // dump($input);
        $vrid = $this->payload['id'];
        /**
         * @var $vr Vr
         */
        $vr = Vr::find($vrid);
        if(!$vr) {
            return $this->response()->error('vR活动不存在');
        }
        $vrScene = new VrScene($input);
        $res = $vr->vrScenes()->save($vrScene);
        if($res) {
            return $this
                ->response()
                ->success('添加完成')
                ->refresh();
        }
        return $this->response()->error('添加失败');

    }

    /**
     * Build a form here.
     */
    public function form()
    {
        //$this->
        //$this->translation = 'wuxuejian.dcat-vr::vr-scene';
        //dump(DcatVrServiceProvider::trans("vr-scene.fields.name"));
        //dump(trans('wuxuejian.dcat-vr::vr-scene.name'));
        //dump(app("translator"));
        //dump($this->payload);
        //$this->display('vr_id')->default($this->payload['id']);

        $this->text('name',DcatVrServiceProvider::trans("vr-scene.fields.name"))->required();
        $this->textarea('description',DcatVrServiceProvider::trans("vr-scene.fields.description"));
        $this->filePlus('scene_file',DcatVrServiceProvider::trans("vr-scene.fields.scene_file"))->required()->removable(false)->retainable()->maxSize(1000*1024)->qiniu('qiniuhf');
        $this->image('cover',DcatVrServiceProvider::trans("vr-scene.fields.cover"))->required()->removable(false)->retainable()->maxSize(2000);
        $this->select('scene_type',DcatVrServiceProvider::trans("vr-scene.fields.scene_type"))->options(['video'=>'视频'])->default('video');
        $this->select('scene_format',DcatVrServiceProvider::trans("vr-scene.fields.scene_format"))->options([2=>'普通vr'])->default(2);
        $this->number('init_tilt',DcatVrServiceProvider::trans("vr-scene.fields.init_tilt"))->default(20)->help('初始tilt');
        $this->number('init_pan',DcatVrServiceProvider::trans("vr-scene.fields.init_pan"))->default(180)->help('初始pan');
        $this->number('init_fov',DcatVrServiceProvider::trans("vr-scene.fields.init_fov"))->default(100)->help('初始fov');
        $this->select('is_loop',DcatVrServiceProvider::trans("vr-scene.fields.is_loop"))->options([1=>'开启',0=>'不开启'])->default(0);
        $this->select('status')->options([1=>'正常',0=>'关闭'])->default(0);


    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return [
            //'name'  => 'John Doe',
            //'email' => 'John.Doe@gmail.com',
        ];
    }
}
