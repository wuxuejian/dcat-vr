<?php

namespace Wuxuejian\DcatVr\Repositories;

use Wuxuejian\DcatVr\Models\VrScene as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class VrScene extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
