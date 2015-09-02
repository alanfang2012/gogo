<?php
//gogo的配置文件
return array(
    //'配置项'=>'配置值'
    'TMPL_ENGINE_TYPE'  => 'Smarty',     // 默认模板引擎 以下设置仅对使用Think模板引擎有效
    //设置默认请求分组
    'DEFAULT_MODULE'    =>  'Home',  // 默认模块
    //设置允许访问的分组列表信息,使得路由在没有定义分组的时候可以做对比
    'MODULE_ALLOW_LIST' =>  array('Admin','Home'),  
    'URL_MODEL'=> 0,
    //给页面底部设置跟踪信息
    'SHOW_PAGE_TRACE' => true,
    //给smarty做参数配置
    'TMPL_ENGINE_CONFIG' => array(
        'left_delimiter' => '<@@',
        'right_delimiter' => '@@>',
    ),
    
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型 mysql sql_server oracle等
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'fang',          // 数据库名
    'DB_USER'               =>  'fang',      // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'gogo_',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(), // 数据库连接参数    
    'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',

    'SESSION_OPTIONS'=>array(
        'SESSION_NAME'=>'ThinkID',                // 默认Session_name
        //'SESSION_PATH'=>'',                        // 采用默认的Session save path
        'SESSION_TYPE'=>'db',                        // 默认Session类型 支持 DB 和 File
        'SESSION_EXPIRE'=>'300000',                // 默认Session有效期
        'SESSION_TABLE'=>'nm_session',        // 数据库Session方式表名
        //'type'=> 'db',//session采用数据库保存
        //'expire'=>1440,//session过期时间，如果不设就是php.ini中设置的默认值
      ),
);

