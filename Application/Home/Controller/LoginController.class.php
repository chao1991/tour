<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {

  
    public function index(){
        $this->redirect('User/index');

    }
    public function login(){

        $username=I('post.username');
        $password=I('post.passwd');
        $password=md5($password);
        $login_table = M('users');
        $result=$login_table->where("username='%s' and password='%s'",$username,$password)->find();

        if($result){
            echo '<script language="javascript">';
            echo "location.href='http://localhost/datamine/index.html'"; 
            echo '</script>';
            $_SESSION['uid']=$result['id'];
        }else{
            $result1=$login_table->where("username='%s'",$username)->find();
            if(!$result1){
                echo '<script language="javascript">';
                echo 'alert("username is error");';
                echo "location.href='http://localhost/datamine/login.html'"; 
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                header("Location: http://localhost/datamine/login.html");
                echo 'alert("password is error");';
                echo '</script>';
            }

        }    
    } 

    public function logout(){
        if($_SESSION['uid'])
        session_destroy();
        echo '<script language="javascript">';
         echo 'alert("退出成功");';
         header("Location: http://localhost/datamine/login.html");
         echo '</script>';
       
    }

    public function register(){

        $username=I('post.username');
        $password=I('post.password');
        $password1=I('post.password1');

        $table=M('users');
        $temp=$table->where("username='%s'",$username)->select();
        if(strlen($password)<6){
            echo json_encode(array('status' => 'error', 'msg'=>'密码长度应大于等于6'));
        exit;
        }
        if($password!=$password1){
            echo json_encode(array('status' => 'error', 'msg'=>'两次输入的密码不一致'));
        exit;
        }
        $password=md5($password);
        
        $data['username']=$username;
        $data['password']=$password;
        $data['ctime']=date('Y-m-d H:i:s');
        $result=$table->add($data);
        if(!$result){
        echo json_encode(array('status' => 'error', 'msg'=>'注册失败'));
        }        
        else{
        echo json_encode(array('status' => 'success', 'msg'=>'注册成功'));
        }
           
        
    }



}