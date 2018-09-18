<?php

return [
    'app_name' => 'Qyou',
    'app_size' => 'http://myqyou.com/',
    'app_key' => '92e6yvskfh08a17cdbnwjx3grqzmi4lt5uop',

    'db' => [
        'name' => 'short_url',
        'username' => 'root',
        'password' => 'root',
        'port' => '3306',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],

    'nav' => [
        'nvzhuang' => '女装',
        'nanzhuang' => '男装',
        'xiebao' => '鞋包',
        'peishi' => '配饰',
        'meizhuang' => '美妆',
        'jiaju' => '家居',
        'muying' => '母婴',
        'meishi' => '美食',
        'shuma' => '数码',
        'neiyi' => '内衣',
        'jiazhuang' => '家装',
        'huwai' => '户外',
        'jiadian' => '家电',
        'qimo' => '汽摩',
        'tushu' => '图书',
        'wenyu' => '文娱',
        'shenhuo' => '生活',
        'youxi' => '游戏'
    ]
];