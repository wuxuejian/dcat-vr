<?php

namespace Wuxuejian\DcatVr\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wuxuejian\DcatVr\Http\Resources\VrResource;
use Wuxuejian\DcatVr\Models\Vr;

class VrController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return  response()->json(['data'=>'','meta'=>'dfd']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Vr $vr)
    {
        //
        if($vr->status!=1) {
            return response()->json(['code'=>'404','msg'=>"资源不存在"])->setStatusCode(404);
        }
        $vr->load(['vrScenes'=>function($query) {
            return $query->where('status',1);
        }]);
        return VrResource::make($vr)->additional(['code'=>200,'msg'=>'success'])->response();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
