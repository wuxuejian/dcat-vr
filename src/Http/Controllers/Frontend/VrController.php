<?php

namespace Wuxuejian\Http\Controllers\Frontend;

use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Routing\Controller;

class VrController extends Controller
{
    public function index()
    {
        return response()->json(['meta'=>"",'data'=>[]]);
    }
}
