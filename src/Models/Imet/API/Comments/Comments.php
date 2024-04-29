<?php

namespace AndreaMarelli\ImetCore\Models\Imet\API\Comments;

use AndreaMarelli\ImetCore\Models\Imet\v2\Imet as ImetV2;
use AndreaMarelli\ImetCore\Models\Imet\v2\Imet_Eval as Imet_EvalV2;

class Comments
{
    /**
     * @param $form_id
     * @return array
     */
    public static function get_comments($form_id): array
    {
        $comments = [];
        foreach (ImetV2::$modules as $categories) {
            static::parse_comments($categories, $form_id, $comments);
        }

        foreach (Imet_EvalV2::$modules as $categories) {
            static::parse_comments($categories, $form_id, $comments);
        }

        return $comments;
    }

    private static function parse_comments(array $categories, int $form_id, array &$comments): void
    {
        foreach ($categories as $module) {
            if (in_array("Comments", $module::getModuleFieldsNames())) {
                $items = $module::where(['FormID' => $form_id])->get();
                foreach ($items as $item) {
                    if (isset($item['Comments'])) {
                        $module_code = $item->module_code;
                        $comments[$module_code] = $comments[$module_code] ?? [];

                        if (!in_array($item['Comments'], $comments[$module_code])) {
                            $comments[$module_code][] = $item['Comments'];
                        }

                    }
                }
            }
        }
    }
}
