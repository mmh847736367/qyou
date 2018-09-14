<?php
/**
 * Created by PhpStorm.
 * User: jiyun
 * Date: 2018/9/13
 * Time: 16:51
 */
require_once '../vendor/autoload.php';

use App\TaobaoSpider;

$url = $_GET['url'] ?? '';
$page = $_GET['p'] ?? '';

echo TaobaoSpider::getTaobaoShow($url);

