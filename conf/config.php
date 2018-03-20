<?php

    return  [
        'app_email'  => "594914677@qq.com",
        'app_author' => "liqi",

        'app_debug'  => true,
        'app_trace'  =>false,

        'url_route_on' => true,
        'url_route_must' => false,
        //'default_return_type'   => 'json',
        'url_html_suffix' => 'html|php',

        'view_replace_str'=>[
            '__PUBLIC__'=>'/public/static/',
            '__JS__'=>'/public/static/js/',
            '__CSS__'=>'/public/static/css/',
            '__IMG__'=>'/public/static/image/',
            '__FONTS__'=>'/public/static/fonts/',
            '__LAYUI__'=>'/public/static/layuis/',
        ],

        'http_exception_template'    =>  [
            // 定义404错误的重定向页面地址
            404 =>  APP_PATH.'404.html',
        ],
        //分页配置
        'paginate'               => [
            'type'      => 'page\Page',
            'var_page'  => 'page',
            'list_rows' => 15,
        ],

    ];
?>