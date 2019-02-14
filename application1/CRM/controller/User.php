<?php
namespace app\CRM\controller;
use think\Controller;
use app\CRM\model\user_info; 

class User extends Controller
{
    public function login()
    {     	
    	$uname = $_POST['uname'];
    	$pwd = $_POST['pwd'];
    	
    	$User = new user_info;
    	$condition['Uname'] = $uname;
    	$userlog = $User->where($condition)->select();
    	 	
        if(0==count($userlog))
      	$this->error('登录失败，用户不存在！');
    else{
        if($pwd!=$userlog[0]['Upwd'])
            $this->error('登录失败，密码错误!');
        else
        {
        //echo "用户名：".$_POST['uid']."密码：".$userlog[0]['Upwd']."权限：".$userlog[0]['Uroot'];
        if($userlog[0]['Uroot']=="管理员")
        //echo"管理员登录";
        	$this->success('管理员登录',	'User/root_in');
        else
        	$this->success('用户登录',	'User/user_in');
        }

    	}
    }
    public function root_in()
    {
 	 return view();
    }
    public function user_in()
    {
    return view();
    }
    
}
