<?php namespace Controllers;

use Controllers\HelperController as Helper;

class PageController
{
    public static function get($filename)
    {
        $post = __DIR__."/../../".PAGE_FOLDER."/$filename.md";

        list($title, $content) = Helper::parse($post);

        return [
            'TITLE' => $title,
            'CONTENT' => $content
        ];
    }
}
