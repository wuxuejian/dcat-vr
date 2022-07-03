<?php


namespace Wuxuejian\DcatVr\Http\Actions\Grid;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Http\Request;
use Wuxuejian\DcatVr\Http\Forms\CreateVrSceneForm;


class EditVrScenceAction extends RowAction
{
    /**
     * @return string
     */
    protected $title = '编辑';



    public function render()
    {
        $form = CreateVrSceneForm::make()->payload(['id'=>$this->getKey()]);
        return Modal::make()->lg()
            ->title($this->title)
            ->body($form)
            ->button($this->title);
    }

}
