<?php

namespace Tahir\CMS\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Media extends Model
{
    use HasFactory;
    public static function resize($path) {

        $variants = [];
        $image_size_variants = config('tacms.media_sizes', []);
        foreach($image_size_variants as $suffix => $image_variant) {

            $img = Image::make($path);
            
            $variant_path = self::getVariantName($path, $suffix);
            $width = isset($image_variant['width']) ? $image_variant['width'] : null;
            $height = isset($image_variant['height']) ? $image_variant['height'] : null;
            $crop = isset($image_variant['crop']) ? $image_variant['crop'] : false;
            $img = Image::make($path);
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            if($crop){
                $img->fit($width, $height);
            }
            $img->save($variant_path);
            $variants[$suffix] = $variant_path;
        }
        return $variants;
    }

    private static function getVariantName( $path, $suffix ) {
        $pathinfo = pathinfo($path);
        return $pathinfo['dirname'] . '/' . $pathinfo['filename'].'_' . $suffix . '.' .$pathinfo['extension'];
    }

    public function deleteFiles() {
        if($this->type == 'image'){
            $children = Media::where('parent', '=', $this->id)->get();
            foreach($children as $child){
                $child->delete();
                Storage::delete($child->path);
            }
        }
        Storage::delete($this->path);
        $this->delete();
    }
}
