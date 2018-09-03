<?php
/**
 * Created by PhpStorm.
 * User: Cacing
 * Date: 06/03/2018
 * Time: 15:01
 */

namespace COOEM\Core\Classes;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class Uploader
{
    public $desc = "this class is used for ImageUpload handler";

    public function save(Request $r , $name , $to = null , $q = 90 , $crop = false , $option = ["base" => false])
    {
        $saveTo = public_path(config('core.upload_path') . '\\' . $to . '\\');

        if (!file_exists($saveTo)) {
            @mkdir($saveTo , 0755);
        }

        if(!$option['base']){
            $image = Input::file($name);
            if (!is_array($image)) {
                if ($r->hasFile($name)) {
                    if ($r->file($name)->isValid()) {
                        $ext = strtolower($image->getClientOriginalExtension());
                        $filename = date('YmdHis') . "_" . md5($image->getClientOriginalName()) . "." . $ext;
                        Image::make($image)->save($saveTo . $filename , $q);
                        if (empty($to)) {
                            return config('core.upload_path') . '/' . $filename;
                        } else {
                            return config('core.upload_path') . '/' . str_replace('\\' , '/' , $to) . '/' . $filename;
                        }
                    }
                    return null;
                }
            } else {
                throw new \Exception('cannot accept request with array format');
            }
        } else {
            if(!empty($r->$name)){
                $image = $r->$name;
                $filename = date('YmdHis') . "_" . md5('cooem_developer')."."."png";
                Image::make($image)->save($saveTo . $filename , 100);

                if (empty($to)) {
                    return config('core.upload_path') . '/' . $filename;
                } else {
                    return config('core.upload_path') . '/' . str_replace('/' , '/' , $to) . '/' . $filename;
                }
            }
        }
    }
}