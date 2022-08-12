<?php
namespace Wuxuejian\DcatVr\Models\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FullUrl
{
    public static function getFullUrl($url,$disk)
    {
        if(is_string($url)) {
            if(!$url) {
                return '';
            }
            if (Str::contains($url, '//')) {
                return $url;
            }
            return Storage::disk($disk)->url($url);
        }

        if(is_array($url)) {
            $urls = collect($url);
            $newUrls = $urls->map(function($item,$key) use($disk){
                if(is_string($item)) {
                    if(!$item||Str::startsWith($item,['http','https','//'])) {
                        return $item;
                    } else {
                        return Storage::disk($disk)->url($item);
                    }

                } else {
                    return self::getFullUrl($item,$disk);
                }

            });
            //dump($url);
            return $newUrls;
        }

    }
}
