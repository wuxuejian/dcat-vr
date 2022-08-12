<?php

namespace Wuxuejian\DcatVr;

use Dcat\Admin\Extend\Setting as Form;

class Setting extends Form
{
    public function title()
    {
        return $this->trans('fdfd');
    }
    public function form()
    {
        $this->text('disk','图片磁盘')->required();
        $this->text('disk_video','视频磁盘')->required();
        $this->text('vr-dir','目录');
    }
}
