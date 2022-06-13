<?php

namespace Wuxuejian\DcatVr\Http\Controllers;

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
        return Form::make(new VrScene(), function (Form $form) {
            $form->display('id');
            $form->text('vr_id');
            $form->text('name');
            $form->text('description');
            $form->text('scene_file');
            $form->text('cover');
            $form->text('scene_type');
            $form->text('init_tilt');
            $form->text('init_pan');
            $form->text('init_fov');
            $form->text('scene_format');
            $form->text('is_loop');
            $form->text('status');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
