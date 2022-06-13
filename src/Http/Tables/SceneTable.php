<?php
namespace Wuxuejian\DcatVr\Http\Tables;


use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use Wuxuejian\DcatVr\Http\Actions\Grid\CreateVrSceneAction;
use Wuxuejian\DcatVr\Http\Actions\Grid\DelOrRestoreVrScenceAction;
use Wuxuejian\DcatVr\Repositories\Vr;
use Wuxuejian\DcatVr\Repositories\VrScene;

class SceneTable extends LazyRenderable
{

    public function grid(): Grid
    {
        //dump($this->payload);
        $vrId = $this->key;
        return Grid::make(new VrScene(),function(Grid $grid) use($vrId) {
            if($vrId) {
                $grid->model()->where('vr_id',$vrId);
            }
            $grid->model()->withTrashed();
            $grid->disableRowSelector();
            $grid->setActionClass(Grid\Displayers\Actions::class);
            $grid->disableEditButton();
            $grid->disableCreateButton();
            $grid->disableDeleteButton();
            $grid->disableActions();
            $grid->column('name');
            $grid->column('cover');
            $grid->column('status')->switch();
            $grid->column('deleted_at')->action(new DelOrRestoreVrScenceAction());
            //$grid->disableActions(false);
            //$grid->actions([new CreateVrSceneAction()]);
            //$grid->disableActions();
            //$grid->disableCreateButton();
            $grid->setName('hfidho'.$vrId);
            $grid->setResource("dcat-vr/vrscenes");

        });
        // TODO: Implement grid() method.
    }
}
