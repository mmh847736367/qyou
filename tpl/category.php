<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $c['app_name'] ?></title>
    <link rel="stylesheet" href="<?= $c['app_size'] ?>css/mystyles.css">
</head>
<body>
<nav class="navbar is-primary has-shadow" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-start">
            <a class="navbar-item" href="<?= $c['app_size'] ?>">
                首页
            </a>
            <a class="navbar-item" href="/nvzhuang/">
                女装
            </a>
            <a class="navbar-item" href="/nanzhuang/">
                男装
            </a>
            <a class="navbar-item" href="/xiebao/">
                鞋包
            </a>
            <a class="navbar-item" href="/peishi/">
                配饰
            </a>
            <a class="navbar-item" href="/meizhuang/">
                美妆
            </a>
            <a class="navbar-item" href="/jiaju/">
                家居
            </a>
            <a class="navbar-item" href="/muying/">
                母婴
            </a>
            <a class="navbar-item" href="/meishi/">
                美食
            </a>
            <a class="navbar-item" href="/shuma/">
                数码
            </a>
            <a class="navbar-item" href="/neiyi/">
                内衣
            </a>
            <a class="navbar-item" href="/jiazhuang/">
                家装
            </a>
            <a class="navbar-item" href="/huwai/">
                户外
            </a>
            <a class="navbar-item" href="/jiadian/">
                家电
            </a>
            <a class="navbar-item" href="/qimo/">
                汽摩
            </a>
            <a class="navbar-item" href="/tushu/">
                图书
            </a>
            <a class="navbar-item" href="/wenyu/">
                文娱
            </a>
            <a class="navbar-item" href="/shenhuo/">
                生活
            </a>
            <a class="navbar-item" href="/youxi/">
                游戏
            </a>

        </div>
    </div>
</nav>

<main class="bd-main">
    <div class="container">

        <nav class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li><a href="<?= $c['app_size'] ?>">首页</a></li>
                <li class="is-active"><a href="#" aria-current="page"><?= $q; ?></a></li>
            </ul>
        </nav>

        <?php foreach ($data as $items): ?>
            <div class="columns">

                <?php foreach ($items as $item) : ?>
                    <div class="column is-3">
                        <div class="card">
                            <div class="card-image">
                                <a href="<?= $item->url ?>" target="_blank">
                                    <figure class="image is-1by1">
                                        <img src="<?= $item->img2 . '_300x300.jpg'; ?>" alt="Placeholder image">
                                    </figure>
                                </a>
                            </div>
                            <h3 class="good-title">
                                <a target="_blank" class="is-size-7" href="
                            <?php
                                if( strpos($item->url,'a.m.taobao.com') !== false ) {
                                    $id = mysub($item->url, 'com/i','.htm');
                                } else {
                                    $id = mysub($item->url, 'id=','&');
                                }
                                echo '/'.$uri.'/'. jiaohuan_1(tihuan_1($id), 3). '.html';

                                ?>" title="<?= $item->title; ?>">
                                    <?php
                                    $host = parse_url($item->url, PHP_URL_HOST);
                                    if (strpos($host, 'taobao') !== false) {
                                        echo '<img src="/images/icon_1.png">';
                                    } else {
                                        echo '<img src="/images/icon_2.png">';
                                    }
                                    ?>
                                    <?= $item->title; ?>
                                </a>
                            </h3>
                            <div class="good-price is-clearfix">
                                <span class="price-current"><em>￥</em><?= (int) $item->price ?></span>
                                <?php if ($item->price != $item->originalPrice) : ?>
                                    <span class="price-old"><em>￥</em><?= (int) $item->originalPrice ?></span>
                                <?php endif; ?>
                                <span class="is-size-7 is-pulled-right " style="color: #999">已售<?= $item->sold; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php endforeach; ?>

        <nav class="pagination is-centered" role="navigation" aria-label="pagination">


            <ul class="pagination-list">
                <?= $pageHtml; ?>
            </ul>
        </nav>

        <div class="relate_words">
            <?php foreach ($words as $k => $v) :?>
                <?php if($k == 0):?>
                    热门品牌：
                <?php else: ?>
                    |
                <?php endif;?>
                <a href="<?= $v['url'] ?>"><?= $v['words'] ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<footer class="bd-footer">
    <div class="container">
        <div class="footer-links has-text-centered">
            <div class="columns">
                <div class="column is-3">
                    <p class="bd-footer-title">
                        <span>关于我们</span>
                    </p>
                    <p>
                        <a href="">关于我们</a>
                    </p>
                    <p>
                        <a href="">联系我们</a>
                    </p>
                    <p>
                        <a href="">QQ公众号</a>
                    </p>
                    <p>
                        <a href="">站长统计</a>
                    </p>
                </div>
                <div class="column is-3">
                    <p class="bd-footer-title">
                        <span>橙子素材</span>
                    </p>
                    <p>
                        <a href="">橙子科技</a>
                    </p>
                    <p>
                        <a href="">橙子图书网</a>
                    </p>
                    <p>
                        <a href="">橙子问答</a>
                    </p>
                    <p>
                        <a href="">橙子问答英文网</a>
                    </p>
                </div>
                <div class="column is-3">
                    <p class="bd-footer-title">
                        <span>橙子娱乐</span>
                    </p>
                    <p>
                        <a href="">移动影音网</a>
                    </p>
                    <p>
                        <a href="">移动图书网</a>
                    </p>
                    <p>
                        <a href="">移动文库</a>
                    </p>
                </div>
                <div class="column is-3">
                    <p class="bd-footer-title">
                        <span>QQ客服</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            Copyright © 2008-2018  myqyou.com All Rights Reserved
        </div>
    </div>
</footer>
</body>
</html>