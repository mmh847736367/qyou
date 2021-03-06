<?php



require_once '../vendor/autoload.php';
$c = require_once '../config.php';
require '../bootstrap.php';

use App\TaobaoSpider;
use App\Page;

$db = new App\QueryBuilder(App\Connection::make($c['db']));
$q = $_GET['q'] ?? '';
$page =  $_GET['p'] ?? 1;


//在数据库中查询该关键字，没有就跳转404
$deKeyWord = tihuan_2(jiaohuan_2($q,3));
$statement = $db->pdo->prepare("select keyword, url from links where keyword = :wd");
$statement->execute([':wd' => $deKeyWord]);
$res = $statement->fetchAll();
if(count($res) == 0) {
    Header("HTTP/1.1 404 Not Found");
    exit;
}

$q = $res[0]['url'];


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
include_once '../tpl/search.php';




