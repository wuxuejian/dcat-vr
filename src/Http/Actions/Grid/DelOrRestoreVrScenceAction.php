<?php


namespace Wuxuejian\DcatVr\Http\Actions\Grid;
use Dcat\Admin\Grid\RowAction;
use Illuminate\Http\Request;


class DelOrRestoreVrScenceAction extends RowAction
{
    protected $title = '';

    protected $model;


    protected function html()
    {

        $icon = ($this->row->{$this->column->getName()})?'恢复':'删除';

        return <<<HTML
<a  class="{$this->getElementClass()} fa " href="####">{$icon}</a>
HTML;
    }

    protected function resolverScript()
    {
        return <<<'JS'
function (target, results) {
console.log(target.html())
let label = '';
if(target.html() =='删除') {
 target.html('恢复')
} else {
    target.html('删除')
}

}
JS;
    }

    public function handle(Request $request)
    {
        $key = $this->getKey();
        $model = $request->get('model');
        $x = $model::withTrashed()->findOrFail($key);

        if($x->deleted_at) {
            $x->restore();
            $msg = '已恢复';
        } else {
            $x->delete();
            $msg = '已删除';
        }


        return $this->response()->success($msg);
    }

    public function confirm()
    {

        return [($this->row->{$this->column->getName()})?'要恢复吗':'要删除吗'];
    }

    public function parameters()
    {
        return [
            'model' => $this->modelClass(),
        ];
    }

    public function modelClass()
    {
        return get_class($this->parent->model()->repository()->model());
    }

}
