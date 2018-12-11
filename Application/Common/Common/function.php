<?php

/**
 * 判断用户是否已经登录
 */
function is_login(){
    $user = session('user_auth');
    if(empty($user)){
        return 0; 
    } else {
        return session('user_auth_sign') == data_auth_sign($user) ? $user['uid'] : 0;
    }
}


/**
 * 检测验证码
 * @param integer $id 验证码ID
 * @return boolean
 */
function check_verify($code, $id=1){
    $verify = new \Think\Verify();
    return $verify->check($code,$id);
}



/**
 * 系统非常规MD5加密方法
 * @param  string $str 要加密的字符串
 * @return string 
 */
function think_ucenter_md5($str, $key = 'ThinkUCenter'){
	return '' === $str ? '' : md5(sha1($str) . $key);
}

/**
 * 返回标准形式的当前时间
 *
 */
function think_now_time(){
    return date("Y-m-d H:i:s");
}

function data_auth_sign($data) {
    //数据类型检测
    if(!is_array($data)){
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}

