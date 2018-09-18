<?php
/**
 * Created by PhpStorm.
 * User: jiyun
 * Date: 2018/8/17
 * Time: 11:12
 */

$uri = ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
if(strpos($uri, '/')) {
    $base_uri = strstr($uri, '/', true);
} else {
    $base_uri = $uri;
}
