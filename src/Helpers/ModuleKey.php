<?php
namespace AndreaMarelli\ImetCore\Helpers;

use Illuminate\Support\Str;


class ModuleKey{

    public const separator = '__';

    /**
     * Return ClassName from module key
     *
     * @param $module_key
     * @return string
     */
    public static function KeyToClassName($module_key): ?string
    {
        $items = explode(self::separator, $module_key);

        $module_class = 'AndreaMarelli\\ImetCore\\Models';
        foreach ($items as $index => $item) {
            if($index===1){
                $module_class .= '\\' . $item; // Version
                $module_class .= '\\Modules';
            } else{
                $module_class .= '\\' . ucfirst(Str::camel($item));
            }
        }
        if (class_exists($module_class)) {
            return $module_class;
        }
        return null;
    }

}
