<?php

namespace Modules\Setting\Repositories\Dashboard;

use Jackiedo\DotenvEditor\Facades\DotenvEditor;

class SettingRepository
{
    function __construct(DotenvEditor $editor)
    {
        $this->editor = $editor;
    }

    public function set($request)
    {
        $this->saveSettings($request->except('_token', '_method'));

				return true;
    }

    public function saveSettings($request)
    {
        foreach ($request as $key => $value) {

            if ($key == 'translate')
                  static::setTranslatableSettings($value);

            if ($key == 'images')
                  static::setImagesPath($value, $request);

            if ($key == 'env')
                  static::setEnv($value);

            app('setting')->put($key,$value);
        }
    }

    public static function setTranslatableSettings($settings = [])
    {
        foreach ($settings as $key => $value) {
            app('setting')->put($key,[
              locale()  => $value,
            ]);
        }
    }

    public static function setImagesPath($settings = [])
    {
        foreach ($settings as $key => $value) {
            $image  = setting($key) ;
            if($value){
              deleteFileInStroage(setting($key));
              $request = request();
              $image =   pathFileInStroageForArray($request, "images",$key, "settings") ;
            }
            
            app('setting')->put($key,$image);
            
        }
    }

    public static function setEnv($settings = [])
    {
        foreach ($settings as $key => $value) {
            $file = DotenvEditor::setKey($key, $value, '', false);

            app('setting')->put($key,$value);
        }

        $file = DotenvEditor::save();
//        dd($settings);
    }
}
