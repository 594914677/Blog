<?php
    use think\Route;
    return [
        'index/blog'=>'index/index/blog',
        '__rest__'=>[
            // 指向index模块的blog控制器
            'index/blog'=>'index/index/blog',
        ],
        '__alias__'=>[
            'user'=>'index/Index'
        ]
    ];