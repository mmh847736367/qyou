<?php
/**
 * Created by PhpStorm.
 * User: jiyun
 * Date: 2018/9/17
 * Time: 15:20
 */

require_once 'vendor/autoload.php';
$c = require 'config.php';
$nav = $c['nav'];
$db = new App\QueryBuilder(App\Connection::make($c['db']));

foreach ($nav as $k => $v) {
//    $wd1 = $v;
//    $keyword = substr(md5($wd1), 8, 16);
//    $db->insert('links',['url' => $wd1, 'keyword' => $keyword]);
//    $enKeyWord = jiaohuan_1(tihuan_1($keyword),3);
    $dirName = 'public/'.$k;
//    mkdir($dirName);
    $filname = $dirName. '/index.php';
    $content = '<?php $q="'. $v . '"; require "../category.php";';
    file_put_contents($filname, $content);
}