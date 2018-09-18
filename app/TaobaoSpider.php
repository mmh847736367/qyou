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

    public static function getTaobaoSearchRang($q, $page=1) {

        $url = "https://s.m.taobao.com/search?event_submit_do_new_search_auction=1&_input_charset=utf-8&topSearch=1&atype=b&searchfrom=1&action=home%3Aredirect_app_action&from=1&q={$q}&sst=1&n=20&buying=buyitnow&m=api4h5&abtest=26&wlsort=26&style=list&closeModues=nav%2Cselecthot%2Conesearch&sort=_ratesum&page={$page}";

        $taobaoSearcHtml =  static::guzzle_get($url, 'https://s.m.taobao.com');

        $obj = \GuzzleHttp\json_decode($taobaoSearcHtml);

        return $obj;
    }

    public static function getTaobaoShow($id)
    {
        $url = 'https://item.taobao.com/item.htm?id='.$id;
        $refer = 'https://www.taobao.com';
        $taobaoShowHtml = static::guzzle_get($url,$refer);
        if(strpos(mysub($taobaoShowHtml,'<title>', '</title>'),'tmall') === false) {
            $items = QueryList::html($taobaoShowHtml)->rules([
                'title' => ['div.tb-title h3', 'text' ],
                'price' => ['em.tb-rmb-num', 'text'],
                'photos' => ['ul#J_UlThumb>li>div.tb-pic>a>img', 'data-src', '', function($content) {
                  return strstr($content,'_50x50.jpg', true);
                }],
                'detail' => ['ul.attributes-list', 'html']
            ])->encoding('UTF-8','GB2312')->query()->getData();
            $refer = '淘宝';
        }else{
            $items = QueryList::html($taobaoShowHtml)->rules([
                'title' => ['div.tb-detail-hd h1', 'text' ],
                'price' => ['div.tm-promo-price', 'text'],
                'photos' => ['ul.tb-thumb>li>a>img', 'src', '', function($content) {
                    return strstr($content,'_60x60q90.jpg', true);
                }],
                'detail' => ['ul#J_AttrUL', 'html']
            ])->encoding('UTF-8','GB2312')->query()->getData();
            $refer = '天猫';
        }

        $item = $items[0];
        for ($i = 1; $i < count($items); $i++) {
            $item = array_merge_recursive($item, $items[$i]);
        }
        $item['refer'] = $refer;
        return $item;
//        $TaobaoShowHtml = iconv('GBK','UTF-8',$TaobaoShowHtml);
    }

    /**
     * 抓取百度关键字内容
     *
     * @param [string]title $title 文章标题
     *
     * @return Collection 百度关键字
     */
    static function spiderBaiduKeyWords($title)
    {
        $url = "https://m.baidu.com/recsys/ui/api/rs?title=$title&ak=ZQ4m31EXvKem1HPYzaK8Ekq6opqfhKFK&pc=1&charset=utf-8&entityNum=20";
        $html = static::guzzle_get($url, 'https://m.baidu.com');
        $items = QueryList::html($html)->rules([
            'words' => ['a', 'text'],
        ])->query()->getData();
        return $items->all();
    }


}
