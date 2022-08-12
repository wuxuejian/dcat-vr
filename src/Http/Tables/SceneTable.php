<?php
namespace Wuxuejian\DcatVr\Http\Tables;


use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use Illuminate\Support\Facades\Storage;
use Wuxuejian\DcatVr\DcatVrServiceProvider;
use Wuxuejian\DcatVr\Http\Actions\Grid\CreateVrSceneAction;
use Wuxuejian\DcatVr\Http\Actions\Grid\DelOrRestoreVrScenceAction;
use Wuxuejian\DcatVr\Http\Actions\Grid\EditVrScenceAction;
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
            $setting = DcatVrServiceProvider::setting();
            $grid->model()->withTrashed();
            $grid->disableRowSelector();
            //$grid->setActionClass(Grid\Displayers\Actions::class);
            //$grid->disableEditButton();
            //$grid->disableCreateButton();
            //$grid->disableDeleteButton();
            $grid->disableViewButton();
            //$grid->disableActions();
            $grid->column('name');
            $grid->column('cover')->display(function($cover){
                if(!$cover) return Storage::disk('image')->url('default-cover-image.png');
                return $cover;
            })->image(Storage::disk($setting['disk'])->url(''));
            $grid->column('status')->switch();
            $grid->column('deleted_at')->action(new DelOrRestoreVrScenceAction());
            //$grid->disableActions(false);
            $grid->actions(function($actions) {
               // $actions->append('<a href=""><i class="fa fa-eye"></i></a>');
                //$actions->append(new EditVrScenceAction());
            });
            //$grid->disableActions();
            //$grid->disableCreateButton();
            $grid->setName('hfidho'.$vrId);
            $grid->setResource("dcat-vr/vrscenes");

        });
        // TODO: Implement grid() method.
    }
}
