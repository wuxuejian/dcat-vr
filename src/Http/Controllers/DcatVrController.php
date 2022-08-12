<?php

namespace Wuxuejian\DcatVr\Http\Controllers;



use Dcat\Admin\Widgets\Card;
use Illuminate\Support\Facades\Storage;
use Wuxuejian\DcatVr\DcatVrServiceProvider;
use Wuxuejian\DcatVr\Repositories\Vr;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Wuxuejian\DcatVr\Http\Actions\Grid\CreateVrSceneAction;
use Wuxuejian\DcatVr\Http\Tables\SceneTable;

class DcatVrController extends AdminController
{


    protected $translation = "wuxuejian.dcat-vr::dcat-vr";

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        //dump(DcatVrServiceProvider::trans("dcat-vr.title"));
        //dump(app("translator"));
        return Grid::make(new Vr(), function (Grid $grid) {
            $grid->setName('vr-grid');
            $grid->column('id')->sortable();
            $grid->column('title');
            $grid->column('description')->display('查看')->modal(function(){
                $card = new Card($this->title,$this->description);
                return "<div class='preview-article' style='padding:10px 10px 0'>$card</div>";
            });
            //scence
            $st = SceneTable::make(['vr_id'=>'fhsdifho']);
            ;
            $grid->column('scenes')->display('场景')->modal('changjinglieb',$st->simple());
            $grid->column('link');
            $grid->column('cover')->image(Storage::disk($this->setting('disk','public'))->url(''));
            //$grid->column('is_gyro')->using([1=>'是',0=>'否'])->badge([1=>'primary',0=>'warning']);
            $grid->column('is_gyro')->switch();
            //$grid->column('full_screen')->using([1=>'是',0=>'否'])->badge([1=>'primary',0=>'warning']);;
            $grid->column('full_screen')->switch();
            //$grid->column('status')->using([1=>'是',0=>'否'])->badge([1=>'primary',0=>'warning']);;
            $grid->column('status')->switch();
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });

            $grid->actions([new CreateVrSceneAction()]);
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
        return Show::make($id, new Vr(), function (Show $show) {
            $show->field('id');
            $show->field('title');
            $show->field('description');
            $show->field('link');
            $show->field('cover');
            $show->field('is_gyro');
            $show->field('full_screen');
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
    {//dump(file_get_contents("https://rsf.qiniu.com"));exit;
        return Form::make(new Vr(), function (Form $form) {
            $form->display('id');
            $form->text('title');
            $form->editor('description');
            //$form->text('link');
            $disk = $this->setting('disk','public');

            $vrDir = $this->setting('vr-dir','vr-activitys');
            //dump($disk);exit;
            $form->bigFileUpload('bigimg');
            $form->image('cover')->disk($disk)->dir($vrDir)->uniqueName()->removable(false)->retainable()
            ->saving(function($cover) {
                if(!$cover) return '';
                return $cover;
            });
            $form->switch('is_gyro')->help("是否开启陀螺仪")->default(1);
            $form->switch('full_screen')->help("是否开启全屏")->default(1);
            $form->radio('status')->options([1=>"开启",0=>"关闭"])->default(0);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    private  function setting($key,$default) {
        if($setting = DcatVrServiceProvider::setting($key)) {
            return $setting;
        }
        return $default;
    }
}
