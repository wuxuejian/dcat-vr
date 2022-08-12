<?php

namespace Wuxuejian\DcatVr\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Wuxuejian\DcatVr\Models\Traits\FullUrl;

class Vr extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;
    use FullUrl;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vrScenes() {
        return $this->hasMany(VrScene::class);
    }
}
