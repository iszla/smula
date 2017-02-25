<?php namespace Controllers;

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
                $ctime = $ctime[0];
                break;
            }
        }

        $post = file_get_contents($path);
        $mtime = date("F d Y H:i:s", filemtime($path));

        $contentFound = false;
        $content = "";
        $file = fopen($path, 'r');
        if ($file) {
            while(($line = fgets($file)) !== false) {
                if (strpos($line, 'Title:') === 0) {
                    $title = substr($line, 6);
                }

                if ($contentFound) {
                    if (strpos($line, 'gist:') === 0) {
                        $line = self::gist($line);
                    }
                    $content .= $line;
                }

                if (strpos($line, 'Content:') === 0) {
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
