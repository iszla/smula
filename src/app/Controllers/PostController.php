<?php namespace Controllers;

use Controllers\HelperController as Helper;

class PostController
{
    public static function get($filename)
    {
        $path = __DIR__."/../../".POSTS_FOLDER."/";
        $files = self::allRaw();

        for ($i=0; $i < count($files); $i++) {
            if (preg_match("/\d*-$filename.*/", $files[$i])) {
                $path = $path.$files[$i];
                $ctime = explode('-', $files[$i], 2);
                $ctime = date("F d Y", strtotime($ctime[0]));
                break;
            }
        }

        $post = file_get_contents($path);
        $mtime = date("F d Y H:i:s", filemtime($path));

        list($title, $content) = Helper::parse($path);

        return [
            'TITLE' => $title,
            'CREATED_AT' => $ctime,
            'MODIFIED_AT' => $mtime,
            'CONTENT' => $content
        ];
    }

    public static function allRaw()
    {
        $path = __DIR__."/../../".POSTS_FOLDER;
        $files = array_slice(scandir($path), 2);

        $files = array_reverse($files);

        return $files;
    }

    public static function allTidy()
    {
        $files = self::allRaw();

        for ($i=0; $i < count($files); $i++) {
            $files[$i] = substr(substr($files[$i], 9), 0, -3);
        }

        return $files;
    }

    public static function gist($string)
    {
        $gist = substr($string, 5);

        return '<script src="https://gist.github.com/iszla/'.$gist.'.js"></script>';
    }
}
