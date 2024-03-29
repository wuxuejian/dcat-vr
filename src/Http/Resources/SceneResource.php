<?php


namespace Wuxuejian\DcatVr\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Wuxuejian\DcatVr\DcatVrServiceProvider;
use Wuxuejian\DcatVr\Models\VrScene;

class SceneResource extends JsonResource
{

    public function toArray($request)
    {
        $setting = DcatVrServiceProvider::setting();
        return [
            'id' => $this->id,
            'vr_id' => $this->vr_id,
            'name' => $this->name,
            'description' =>$this->description,
            'scene_file' => VrScene::getFullUrl($this->scene_file,$setting['disk_video']),
            'cover' => VrScene::getFullUrl($this->cover,$setting['disk']),
            'scene_type' => Str::ucfirst($this->scene_type),
            'init_tilt' => $this->init_tilt,
            'init_pan' => $this->init_pan,
            'init_fov' => $this->init_fov,
            'scene_format' => $this->scene_format,
            'is_loop' => $this->is_loop,
            'status' => $this->status,
            'updated_at' => $this->updated_at->format($this->getDateFormat()),
            'vr' => $this->whenLoaded('vr'),
        ];
    }

    public function with($request)
    {
        $this->with = [
            'meta'=> [
                'status' => [1=>'正常',0=>'关闭']
            ]
        ];
        return parent::with($request); // TODO: Change the autogenerated stub
    }
}
