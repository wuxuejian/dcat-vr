<?php

namespace Wuxuejian\DcatVr\Http\Controllers;

use Wuxuejian\DcatVr\DcatVrServiceProvider;
use Wuxuejian\DcatVr\Http\Tables\SceneTable;
use Wuxuejian\DcatVr\Models\VrScene;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class VrSceneController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return SceneTable::make()->grid();
        return Grid::make(new VrScene(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('vr_id');
            $grid->column('name');
            $grid->column('description');
            $grid->column('scene_file');
            $grid->column('cover');
            $grid->column('scene_type');
            $grid->column('init_tilt');
            $grid->column('init_pan');
            $grid->column('init_fov');
            $grid->column('scene_format');
            $grid->column('is_loop');
            $grid->column('status');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new VrScene(), function (Show $show) {
            $show->field('id');
            $show->field('vr_id');
            $show->field('name');
            $show->field('description');
            $show->field('scene_file');
            $show->field('cover');
            $show->field('scene_type');
            $show->field('init_tilt');
            $show->field('init_pan');
            $show->field('init_fov');
            $show->field('scene_format');
            $show->field('is_loop');
            $show->field('status');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {


        return Form::make(VrScene::with('vr'), function (Form $form) {
            $setting = DcatVrServiceProvider::setting();
            $form->display('id');
            $form->display('vr.title');
            $form->display('created_at');
            $form->display('updated_at');
            $form->display('vr.title','VR活动标题');
            $form->text('name')->required();
            $form->textarea('description');
            $form->filePlus('scene_file')->required()->uniqueName()
                ->maxSize(1000*1024)->qiniu($setting['disk_video'])->removable(false)
                ->retainable();
            $form->image('cover')->disk($setting['disk'])->required()->removable(false)->retainable()->maxSize(2000);
            $form->select('scene_type')->options(['Video'=>'视频'])->default('Video');
            $form->select('scene_format')->options([2=>'普通vr'])->default(2);
            $form->number('init_tilt')->default(20)->help('初始tilt');
            $form->number('init_pan')->default(180)->help('初始pan');
            $form->number('init_fov')->default(100)->help('初始fov');
            $form->select('is_loop')->options([1=>'开启',0=>'不开启'])->default(0);
            $form->select('status')->options([1=>'正常',0=>'关闭'])->default(0);
        });
    }
}
