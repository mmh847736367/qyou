<?php
/**
 * Created by PhpStorm.
 * User: jiyun
 * Date: 2018/8/17
 * Time: 12:27
 */
namespace App;

class Page
{
    public  $uri;
    public  $cp;
    public  $lp;
    public  $formate;
    
    public function __construct($uri, $cp, $lp,$formate='cate')
    {
        $this->uri = $uri;
        $this->cp = $cp;
        $this->lp = $lp;
        if($lp == false) {
            $this->lp = 1;
        }
        $this->formate = $formate;
    }

    public function init()
    {
        if($this->cp > $this->lp) {
            $this->cp = $this->lp;
        }
        $prev = $this->cp - 1 ;
        if($prev <= 0) {
            $prev = 1;
        }
        $next = $this->cp + 1 ;
        if($next > $this->lp) {
            $next = $this->lp;
        }
        $alist = '';
        if($this->cp<=3) {
            $page_start = 1;
        } elseif(3<$this->cp && $this->cp< $this->lp-2) {
            $page_start = $this->cp-2;
        } else{
            $page_start = $this->lp-4;
        }

        if($this->formate == 'cate') {
            for ($i = $page_start; $i<$page_start+8; $i++) {
                if($i == $this->cp) {
                    if( $i == 1) {
                        $alist .= "<li><a href='/{$this->uri}/' class='pagination-link is-current'>$i</a></li>";
                    } else{
                        $alist .= "<li><a href='/{$this->uri}/{$i}.html' class='pagination-link is-current'>$i</a><li>";
                    }
                }else {
                    if($i == 1) {
                        $alist .= "<li><a href='/{$this->uri}/' class='pagination-link'>$i</a></li>";
                    } else {
                        $alist .= "<li><a href='/{$this->uri}/{$i}.html'class='pagination-link'>$i</a></li>";
                    }
                }

                if($i == $this->lp) {
                    break;
                }
            }

            if($this->cp >= 2) {
                if( $prev ==1 ) {
                    $page_pre = "<li><a href='/{$this->uri}/' class='pagination-link'> 上一页 </a><li>";
                } else {
                    $page_pre = "<li><a href='/{$this->uri}/{$prev}.html' class='pagination-link'> 上一页 </a><li>";
                }
            } else {
                $page_pre = '';
            }

            if($this->cp <= $this->lp -2) {
                $page_next = "<li><a href='/{$this->uri}/{$next}.html' class='pagination-link' > 下一页 </a></li>";
            }else {
                $page_next = '';
            }

            if($this->cp > 2) {
                $ahome = "<li><a href='/{$this->uri}/' class='pagination-link' >首页</a></li>";
            } else {
                $ahome = '';
            }

            if($this->cp < $this->lp -2) {
                if($this->lp ==1) {
                    $alast = "<li><a href='/{$this->uri}/' class='pagination-link'>尾页</a></li>";
                } else {
                    $alast = "<li><a href='/{$this->uri}/{$this->lp}.html' class='pagination-link'>尾页</a></li>";
                }

            }else {
                $alast = '';
            }
            $html = $page_pre.$alist.$page_next;
        }

        return $html;
    }
}