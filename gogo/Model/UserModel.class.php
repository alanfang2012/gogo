<?php
namespace Model;
use Think\Model;
/**
 * 前台用户模型
 */
class UserModel extends Model{

    public function __construct(){
        parent::__construct();
    }
    // 是否批处理验证
    protected $patchValidate  =  true;
    //给用户注册页面制作表单验证规则
    // 自动验证定义
    protected $_validate = array(
        //用户名必填
        array('user_name','require','用户名必须填写'),
        //用户名不能重复
        array('user_name','','用户名已经存在',0,'unique'),
        array('user_pswd','require','密码必须填写'),
        array('user_pswd','6,14','密码必须是6-14位之间',0,'length'),
    );
    /**
     * [checkNamePwd description]   验证用户名和密码的方法
     * @Author  alanfang
     * @DateTime 2015-09-02T13:45:42+0800
     * @param   string       $name
     * @param   string       $pwd 
     * @return  array           
     */
    public function checkNamePwd($user_name,$password){
        //先验证用户名
        $where['user_name'] =$user_name;
        $user_info = $this->where($where)->find();
        if($user_info!==null){
            //生成密码和盐出来进行校验
            $p_arr = $this->makePwd($user_name,$password);
            if($user_info['user_pswd']===$p_arr['user_pswd'] && $user_info['salt']===$p_arr['salt']){
                return $user_info;
            }
        }
        return false;
    }

    /**
     * [showInfo description] 获取用户信息的方法
     * @Author   alanfang
     * @DateTime 2015-09-02T13:53:59+0800
     * @param    int    $user_id 
     * @return   array              
     */
    public function showInfo($user_id){
        $where['user_id'] = $user_id;
        $user_info = $this->Where($where)->find();
        if($user_info == null){
            return false;
        }
        return $user_info; 
    }

    /**
     * [chkname description]
     * @Author   alanfang2012@163.com
     * @DateTime 2015-09-01T15:55:09+0800
     * @param    string    $user_name [description]
     * @return   boolean
     */
    public function chkName($user_name){
        $where['user_name'] = $user_name;
        $res = $this->Where($where)->find();
        return $res ? true : false;
    }

    /**
     * [_makePwd description] 生成加盐后的密码
     * @Author   alanfang2012@163.com
     * @DateTime 2015-09-02T17:02:43+0800
     * @param    string   $password 
     * @return   array             
     */
    public function makePwd($user_name,$password){
        $p['user_pswd'] = MD5($password.MD5($password.MD5($user_name.$password)));
        $p['salt']= MD5($user_name.MD5($user_name.MD5($password.$user_name)));
        return $p;
    }
}
