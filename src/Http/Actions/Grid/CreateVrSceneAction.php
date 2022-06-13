<?php

namespace Wuxuejian\DcatVr\Http\Actions\Grid;


use Dcat\Admin\Actions\Response;
use Dcat\Admin\Grid\RowAction;
use Dcat\Admin\Traits\HasPermissions;
use Dcat\Admin\Widgets\Form;
use Dcat\Admin\Widgets\Modal;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Wuxuejian\DcatVr\Http\Forms\CreateVrSceneForm;

class CreateVrSceneAction extends RowAction
{
    /**
     * @return string
     */
	protected $title = '添加场景';

    public function render()
    {
        $form = CreateVrSceneForm::make()->payload(['id'=>$this->getKey()]);
        return Modal::make()->lg()
            ->title($this->title)
            ->body($form)
            ->button($this->title);
    }
}
