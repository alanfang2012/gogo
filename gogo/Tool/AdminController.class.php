<?php

namespace Tool;
use Think\Controller;
//后台普通控制器的父类
class AdminController extends Controller{
    //在构造方法里边实现对访问权限的过滤控制功能
    function __construct() {
        parent::__construct();
        //权限访问控制器过滤
        $nowac = CONTROLLER_NAME."-".ACTION_NAME;  //获得当前访问的控制器和操作方法
        //show_bug($nowac);
        //未登录系统用户判断
        $admin_id = session('admin_id');
        $allowlist = "Manager-login,Manager-verifyImg"; //没有登陆系统也允许访问的权限Index-index
        if(empty($admin_id) && strpos($allowlist,$nowac)===false){
            //$url = U(分组/控制器/操作方法);  //生成一个请求的路由地址
            $url = U("Manager/login");  //生成一个请求的路由地址
            $str = <<<eof
                <script type="text/javascript">
                    window.top.location.href="$url";
                </script>
eof;
            echo $str;
        }
        
        //根据"操作者id"获得对应的角色权限信息
        $manager_info = D('Manager')->find(session('admin_id'));
        $role_id = $manager_info['mg_role_id'];
        
        $role_info = D('Role')->find($role_id);
        $role_ac = $role_info['role_auth_ac'];
        //show_bug($role_ac);

        //默认允许访问权限列表
        $allowac = "Manager-logout,Manager-login,Manager-verifyImg,Index-index,Index-left,Index-right,Index-head";
        
        //①判断用户请求的ac是否在其角色的ac里边存在
        //②判断请求的ac 是否是允许列表的权限
        //③判断 超级管理员admin不要限制
        $admin_name = session('admin_name');
        //show_bug(strpos($allowac,$nowac));
        if(strpos($role_ac,$nowac)===false && strpos($allowac,$nowac)===false && $admin_name!=='admin'){//判断$nowac在$role_ac里边第一次出现的位置，没有出现返回"假"
            exit('没有访问权限！');
        }
    }
    
    
    //操作成功的提示方法
    function success($message='',$jumpUrl='',$ajax=false){
        $html = <<<eof
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
<h1>:)</h1>
<p class="success">$message</p>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="$jumpUrl">跳转</a> 等待时间： <b id="wait">3</b>
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>     
                
eof;
    echo $html;
    exit;
    }
}
