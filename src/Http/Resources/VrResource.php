<?php

namespace Wuxuejian\DcatVr\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VrResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->descripton,
            'link' => $this->link,
            'cover' => $this->cover,
            'is_gyro' => $this->is_gyro,
            'full_screen' => $this->full_screen,
            'status' => $this->status,
            'updated_at' => $this->updated_at->format($this->getDateFormat()),
            'scenes' => SceneResource::collection($this->whenLoaded('vrScenes'))
        ];
    }

    public function with($request)
    {
        $with = [
            'meta' => [
                'status' => ['0'=>'禁用','1'=>'正常']
            ]
        ];
        $this->with = $with;
        return parent::with($request); // TODO: Change the autogenerated stub
    }
}
