<?php namespace Render;

use Parsedown;

class View
{
    private static $twig = null;

    public function __construct($engine)
    {
        self::$twig = $engine;
    }

    public static function render($view, $content = null)
    {
        if (isset($content)) {
            $content['CONTENT'] = Parsedown::instance()->text($content['CONTENT']);
        }

        return self::$twig->render($view.'.html', $content);
    }
}

?>
