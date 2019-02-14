<?php
namespace app\CRM\controller;

use think\Controller;
use app\CRM\model\user_info;
use think\Request;
use  think\View;
 
class Rui extends controller
{ 
	
    public function add()
    {  $user_info = new user_info;
    	
       $Uname_add = Request::instance()->param('Uname_add'); 
       $Upwd_add  = Request::instance()->param('Upwd_add'); 
       $Uroot_add = Request::instance()->param('Uroot_add'); 
       $Uposi_add = Request::instance()->param('Uposi_add');  
       $Utel_add  = Request::instance()->param('Utel_add'); 
 
       if ($Uname_add != null){
       $user_info->Uname = $Uname_add;
       $user_info->Upwd = $Upwd_add;
       $user_info->Uroot = $Uroot_add;
       $user_info->Uposi = $Uposi_add;
       $user_info->Utel  = $Utel_add;
       
       $user_info->save();
       
       $this->success('添加成功',	'User/root_in');}
       
       else{$this->error('输入错误，操作失败',	'User/root_in');}    
    }
    
    public function del()
    {
    	$user_info = new user_info;
    	
    	$Uname_del = Request::instance()->param('Uname_del');
    	
    	if($Uname_del != null){
    		
    	user_info::where('Uname',$Uname_del)->delete();

    	$this->success('删除成功','User/root_in');}
    	
    	else{$this->error('输入错误，操作失败',	'User/root_in');}
    	 	
    }
    
    public function upd()
    {
    	$user_info = new user_info;
    	
    	$Uname_upd = Request::instance()->param('Uname_upd'); 
        $Upwd_upd  = Request::instance()->param('Upwd_upd'); 
        $Uroot_upd = Request::instance()->param('Uroot_upd'); 
        $Uposi_upd = Request::instance()->param('Uposi_upd');  
        $Utel_upd  = Request::instance()->param('Utel_upd');
        
        if($Uname_upd != null){
        $condition['Uname'] = $Uname_upd;
    	
    	$user_info->where($condition)
    	->update(['Uname'=>	$Uname_upd,'Upwd'=>$Upwd_upd,'Uroot'=>$Uroot_upd,'Uposi'=>$Uposi_upd,'Utel'=>$Utel_upd]);
    	
    	$this->success('修改成功','User/root_in');} 	
    	else{$this->error('输入错误，操作失败',	'User/root_in');}
    }
    
    public function ser()
    {
    	$user_info = new user_info;
    	$Uname_ser = Request::instance()->param('Uname_ser');
    	
    	if($Uname_ser != null){
    		
    	$condition['Uname'] = $Uname_ser;
    	$Ui = $user_info->where($condition)->select();
    	
    	if(0==count($Ui)){
    		$this->error('查无此人',	'User/root_in');
    	}
    	else{
        $CUpwd_ser = $Ui[0]['Upwd'];
    	$Uroot_ser= $Ui[0]['Uroot'];
    	$Uposi_ser= $Ui[0]['Uposi'];
    	$Utel_ser= $Ui[0]['Utel'];
    	$view = new View();
    	
    	$view->assign('Upwd_ser',$Ui[0]['Upwd']);								
    	$view->assign('Uroot_ser',$Ui[0]['Uroot']);
    	$view->assign('Uposi_ser',$Ui[0]['Uposi']);
    	$view->assign('Utel_ser',$Ui[0]['Utel']);
    	
    	return	$view->fetch();}}
    	else{$this->error('输入错误，操作失败',	'User/root_in');}
    }
}
