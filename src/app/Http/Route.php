<?php namespace Http;

class Route
{
    private static $routes = [];

    public static function get(string $url, $callback)
    {
        self::$routes[$url] = $callback;
    }

    public static function routes(string $url)
    {
        if (array_key_exists($url, self::$routes)) {
            return self::$routes[$url]();
        }

        $urls = explode('/', $url);
        $keys = array_keys(self::$routes);
        for ($i=0; $i < count($keys); $i++) {
            $key = explode('/', $keys[$i]);

            if (count($urls) == 2) {
                if (preg_match('/\{.*\}/', $key[1])) {
                    return self::$routes[$keys[$i]]($urls[1]);
                }
            }

            for ($j=0; $j < count($urls); $j++) {
                if ($urls[$j] == $key[$j]) {
                    if (preg_match('/\{.*\}/', $key[$j+1]) && $j == (count($urls) - 2)) {
                        return self::$routes[$keys[$i]]($urls[$j+1]);
                    }
                }
            }
        }

        return "404 $url\n";
    }
}

?>
