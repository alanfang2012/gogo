<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 首页index的控制器
 */
class IndexController extends Controller {
    
    // public function __construct(){
    //     parent::__construct();
    // }
    /**
     * 首页index
     */
    public function index(){       
        $this->display();
    }
}
