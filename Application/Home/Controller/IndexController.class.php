<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

	//初始化，用户是否登录

  
    public function index(){
        $this->redirect('User/index');

    }
   

}