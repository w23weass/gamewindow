<?php
return array(


    /* URL配置 */
    'URL_CASE_INSENSITIVE'  => false,        // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'             => 2,           // URL模式
    'URL_PATHINFO_DEPR'     => '_',         // PATHINFO URL分割符
    'URL_ROUTER_ON'         => false,       // 是否开启URL路由
	//'配置项'=>'配置值'
    'TMPL_PARSE_STRING'  =>array(
        '__PUBLIC__' => 'Public/Static/', // 更改默认的/Public 替换规则
        '__UPLOAD__' => UPLOAD_PATH, // 增加新的上传路径替换规则
    ),

);
