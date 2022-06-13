<?php

namespace Wuxuejian\DcatVr\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VrScene extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $fillable = [
      'name','description','scene_file','cover','scene_type','init_tilt','init_pan','init_fov','scene_format','is_loop','status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vr() {
        return $this->belongsTo(Vr::class);
    }
}
