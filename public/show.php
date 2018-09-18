<?php
/**
 * Created by PhpStorm.
 * User: jiyun
 * Date: 2018/9/13
 * Time: 16:51
 */
$c = require_once '../config.php';
require_once '../vendor/autoload.php';

use App\TaobaoSpider;



$id = $_GET['id'] ?? '';

$id = tihuan_2(jiaohuan_2($id,3));
$db = new App\QueryBuilder(App\Connection::make($c['db']));

$data = TaobaoSpider::getTaobaoShow($id);
if(is_array($data['photos'])) {
    $data['photos'] = array_slice($data['photos'], 0, 5);
}

$searchtitle1 = mb_substr($data['title'], 0,5);
$searchtitle2 = mb_substr($data['title'], -4);
$searchtitle = $searchtitle1. '+' .$searchtitle2;

$taobaoSearchRang = TaobaoSpider::getTaobaoSearchRang($searchtitle);

if(isset($taobaoSearchRang->listItem)) {
    $rela = $taobaoSearchRang->listItem;
}

$relaItems = [];
if(!empty($rela)) {
    foreach ($rela as $k => $v) {
        $i = (int) floor($k/4);
        $relaItems[$i][] = $v;
    }
}


include_once '../tpl/show.php';

