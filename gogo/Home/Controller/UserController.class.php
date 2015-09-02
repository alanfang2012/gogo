<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 前台用户控制器
 */
class UserController extends Controller{
    public function __construct(){
        parent::__construct();
        //访问权限简略控制
        $allow_actions = array('login','signup');
        $act = ACTION_NAME;
        if(session('user_id')== null){
            if( in_array($act,$allow_actions) == false){
                $this->redirect('user/login');
            }
        }
    }
    /**
     * [signup description] 前台用户登陆
     * @Author   alanfang2012@163.com
     * @DateTime 2015-09-01T21:42:49+0800
     */
    public function login(){
        if(!empty($_POST)){
            $user_mod = new \Model\UserModel;
            $info=$user_mod->checkNamePwd($_POST['user_name'],$_POST['user_pswd']);
            if($info){
                session('user_id',$info['user_id']);
                session('user_name',$info['user_name']);
                $this->redirect('user/info');
            }else{
                $this->redirect('user/login');
            }
        }
        $this->display();
    }

    /**
     * [signup description] 前台用户注册
     * @Author   alanfang2012@163.com
     * @DateTime 2015-09-01T22:27:15+0800
     */
    public function signup(){
        if(!empty($_POST)){
            $user_mod = new \Model\UserModel;
            $res = $user_mod->create();
            if($res){
                $p = $user_mod->makePwd($res['user_name'],$res['user_pswd']);
                $res['user_pswd'] = $p['user_pswd'];
                $res['salt'] = $p['salt'];
                $z = $user_mod->add($res);
                session('user_id',$z);
                session('user_name',$res['user_name']);
                if($z){
                    $this->redirect('user/info');
                }
            } 
            $this->assign('errorInfo',$user_mod->getError());
        }
        $this->display();
    }

    /**
     * [info description] 用户个人信息查看
     * @Author   alanfang2012@163.com
     * @DateTime 2015-09-01T22:22:01+0800
     */
    public function info(){
        $user_id = session('user_id');
        $user_mod = new \Model\UserModel;
        $user_info = $user_mod->showInfo($user_id);
        $this->assign('user_info',$user_info);
        $this->display();
    }

    /**
     * [edit description] 用户个人信息修改
     * @Author   alanfang2012@163.com
     * @DateTime 2015-09-01T22:23:00+0800
     */
    public function edit(){
        if(!empty($_POST)){
            $_POST['user_id'] = session('user_id');
            $_POST['user_name'] = session('user_name');
            $user_mod  = new \Model\UserModel;
            $res = $user_mod->create();
            if($res){
                $z = $user_mod->save();
                if($z){
                    $this->redirect('user/info');
                }
                $this->redirect('user/info');                
            }
        }
        $this->assign('user_id',session('user_id'));
        $this->assign('user_name',session('user_name'));
        $this->display();
    }

    /**
     * [chkname description] 检验用户名字是否注册的接口
     * @Author   alanfang2012@163.com
     * @DateTime 2015-09-01T15:43:39+0800
     * @param    string  $user_name
     * @return   json      
     */
    public function chknameAPI(){
        $user_name =$_GET['user_name'];
        $user_mod= new \Model\UserModel;
        $info=$user_mod->chkName($user_name);
        if($info){
            die(json_encode(array('status'=>"error")));
        }
        die(json_encode(array('status'=>"OK")));
    }
    /**
     * [imgupload description]图片上传接口
     * @Author   alanfang2012@163.com
     * @DateTime 2015-09-02T11:11:23+0800
     */
    public function imguploadAPI(){
        $action = $_GET['act']; 
        // if($action=='delimg'){ //删除图片 
        //     $filename = $_POST['imagename']; 
        //     if(!empty($filename)){ 
        //         unlink('files/'.$filename); 
        //         echo '1'; 
        //     }else{ 
        //         echo '删除失败.'; 
        //     } 
        // }else{ //上传图片 
            $picname = $_FILES['mypic']['name']; 
            $picsize = $_FILES['mypic']['size']; 
            if ($picname != "") { 
                if ($picsize > 5120000) { //限制上传大小 
                    die(json_encode(array('status'=>'error','result'=>'图片大小不能超过500k'))); 
                } 
                $type = strstr($picname, '.'); //限制上传格式 
                if ($type != ".gif" && $type != ".jpg") { 
                    die(json_encode(array('status'=>'error','result'=>'图片格式不对')));
                } 
                $rand = rand(100, 999); 
                $pics = date("YmdHis") . $rand . $type; //命名图片名称 
                //上传路径 
                $pic_path = '.'.UPLOAD_URL.'face/'.$pics; 
                move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path); 
            } 
            $size = round($picsize/1024,2); //转换成kb 
            $arr = array( 
                'name'=>$picname, 
                'pic'=>$pics, 
                'size'=>$size,
                'pic_path'=>$pic_path
            ); 
            die(json_encode($arr)); //输出json数据 
    }

}
