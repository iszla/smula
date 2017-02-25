<?php namespace Controllers;

class PostController
{
    public static function getPost($filename)
    {
        $path = __DIR__."/../../".POSTS_FOLDER."/$filename.md";
        $post = file_get_contents($path);
        $ctime = date("F d Y H:i:s", filectime($path));
        $mtime = date("F d Y H:i:s", filemtime($path));

        $contentFound = false;
        $content = "";
        $file = fopen($path, 'r');
        if ($file) {
            while(($line = fgets($file)) !== false) {
                if (strpos($line, 'Title=') === 0) {
                    $title = substr($line, 6);
                }

                if ($contentFound) {
                    $content .= $line;
                }

                if (strpos($line, 'Content=') === 0) {
                    $contentFound = true;
                }
            }
        }

        return [
            'TITLE' => $title,
            'CREATED_AT' => $ctime,
            'MODIFIED_AT' => $mtime,
            'CONTENT' => $content
        ];
    }
}
