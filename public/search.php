<?php



require_once '../vendor/autoload.php';
$c = require_once '../config.php';
require '../bootstrap.php';
use App\TaobaoSpider;
use App\Page;


$q = $_GET['q'] ?? '';
$page =  $_GET['p'] ?? 1;


$items = TaobaoSpider::getTaobaoSearch($q, $page);
$listItem = $items->listItem;

$totalPage = $items->totalPage;
$pageHtml = (new Page($base_uri,$page,$totalPage))->init();
$data = [];


foreach ($listItem as $k => $v) {
    $i = (int) floor($k/4);
    $data[$i][] = $v;
}

//print_r($data);
include_once '../tpl/search.php';




