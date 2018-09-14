<?php
/**
 * Created by PhpStorm.
 * User: jiyun
 * Date: 2018/9/13
 * Time: 9:03
 */
namespace App;

use QL\QueryList;

class TaobaoSpider extends Spider
{

    public static function getTaobaoSearch($q, $page=1) {

        $url = "https://s.m.taobao.com/search?event_submit_do_new_search_auction=1&_input_charset=utf-8&topSearch=1&atype=b&searchfrom=1&action=home%3Aredirect_app_action&from=1&q={$q}&sst=1&n=20&buying=buyitnow&m=api4h5&abtest=22&wlsort=22&style=list&closeModues=nav%2Cselecthot%2Conesearch&sort=_sale&page={$page}";

        $taobaoSearcHtml =  static::guzzle_get($url, 'https://s.m.taobao.com');

        $obj = \GuzzleHttp\json_decode($taobaoSearcHtml);

        return $obj;
    }

    public static function getTaobaoShow($url)
    {
        $url = 'detail.m.tmall.com/item.htm?id=561498041581&abtest=12&rn=ec77c0dcca809ff77fdde229315c68f0&sid=585a40aac847feb9e4375f8bf7abf41b';
        $refer = 'https://www.tmall.com';
        $taobaoShowHtml = static::curl_get($url,$refer);
        die(var_dump($taobaoShowHtml));
        $data = QueryList::html($taobaoShowHtml)->rules([
            'title' => ['div.tb-title h3', 'text' ],
            'price' => ['em.tb-rmb-num', 'text'],
            'color' => ['ul>li.tb-txt>a>span', 'text'],
        ])->encoding('UTF-8','GB2312')->query()->getData();

        var_dump($data);
        die();
//        $TaobaoShowHtml = iconv('GBK','UTF-8',$TaobaoShowHtml);
    }

}
