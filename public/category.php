<?php



require_once '../../vendor/autoload.php';
$c = require_once '../../config.php';
require '../../bootstrap.php';

use App\TaobaoSpider;
use App\Page;

$db = new App\QueryBuilder(App\Connection::make($c['db']));

$page =  $_GET['p'] ?? 1;

$items = TaobaoSpider::getTaobaoSearch($q, $page);
$listItem = $items->listItem;

$totalPage = $items->totalPage;
//die(var_dump($totalPage));
$uri = pathinfo($uri.'1.html',PATHINFO_DIRNAME );
$pageHtml = (new Page($uri,$page,$totalPage))->init();


$words = TaobaoSpider::spiderBaiduKeyWords($q);
foreach ($words as $key =>$value) {
    $wd1 = $value['words'];
    $keyword = substr(md5($wd1), 8, 16);
    $db->insert('links',['url' => $wd1, 'keyword' => $keyword]);
    $enKeyWord = jiaohuan_1(tihuan_1($keyword),3);
    $words[$key]['url'] = '/s/'.$enKeyWord . '/';
}


$data = [];
foreach ($listItem as $k => $v) {
    $i = (int) floor($k/4);
    $data[$i][] = $v;
}


//print_r($data);
include_once '../../tpl/search.php';
