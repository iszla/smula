<?php namespace Controllers;

class HelperController
{
    public static function gist($string)
    {
        $gist = substr($string, 5);

        return '<script src="https://gist.github.com/iszla/'.$gist.'.js"></script>';
    }

    public static function parse($path)
    {
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
        fclose($file);

        return [$title, $content];
    }
}
