<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $c['app_name'] ?></title>
    <link rel="stylesheet" href="<?= $c['app_size'] ?>css/mystyles.css">
</head>
<body>
<main class="section">
    <div class="container">

        <nav class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li><a href="<?= $c['app_size'] ?>">首页</a></li>
                <li class="is-active"><a href="#" aria-current="page">"<?= $q; ?>"相关搜索</a></li>
            </ul>
        </nav>

        <?php foreach ($data as $items): ?>
            <div class="columns">

                <?php foreach ($items as $item) : ?>
                <div class="column">
                    <div class="card">
                        <div class="card-image">
                            <a href="<?= $item->url ?>" target="_blank">
                                <figure class="image is-1by1">
                                    <img src="<?= $item->img2 . '_300x300.jpg'; ?>" alt="Placeholder image">
                                </figure>
                            </a>
                        </div>
                            <h3 class="good-title">
                                <a target="_blank" class="is-size-7" href="<?= $item->url ?>" title="<?= $item->title; ?>">
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

    </div>
</main>
</body>
</html>