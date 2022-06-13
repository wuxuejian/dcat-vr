<?php

namespace Wuxuejian\DcatVr\Repositories;

use Wuxuejian\DcatVr\Models\Vr as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Vr extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
