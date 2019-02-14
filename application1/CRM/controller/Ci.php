<?php
namespace app\CRM\controller;

use think\Controller;
use app\CRM\model\client_info;
use think\Request;
use  think\View;


class Ci extends controller
{ 
	
    public function add()
    {  $client_info = new client_info;
    	
       $Cname_add = Request::instance()->param('Cname_add'); 
       $Csex_add  = Request::instance()->param('Csex_add'); 
       $Ccomp_add = Request::instance()->param('Ccomp_add'); 
       $Cposi_add = Request::instance()->param('Cposi_add');  
       $Ctel_add  = Request::instance()->param('Ctel_add'); 
 
       if ($Cname_add != null){
       $client_info->Cname = $Cname_add;
       $client_info->Csex  = $Csex_add;
       $client_info->Ccomp = $Ccomp_add;
       $client_info->Cposi = $Cposi_add;
       $client_info->Ctel  = $Ctel_add;
       
       $client_info->save();
       
       $this->success('添加成功','User/user_in');}
       
       else{$this->error('输入错误，操作失败','User/user_in');}    
    }
    
    public function del()
    {
    	$client_info = new client_info;
    	
    	$Cname_del = Request::instance()->param('Cname_del');
    	
    	if($Cname_del != null){
    		
    	client_info::where('Cname',$Cname_del)->delete();

    	$this->success('删除成功','User/user_in');}
    	
    	else{$this->error('输入错误，操作失败',	'User/user_in');}
    	 	
    }
    
    public function upd()
    {
    	$client_info = new client_info;
    	
    	$Cname_upd = Request::instance()->param('Cname_upd'); 
        $Csex_upd  = Request::instance()->param('Csex_upd'); 
        $Ccomp_upd = Request::instance()->param('Ccomp_upd'); 
        $Cposi_upd = Request::instance()->param('Cposi_upd');  
        $Ctel_upd  = Request::instance()->param('Ctel_upd');
        
        if($Cname_upd != null){
        $condition['Cname'] = $Cname_upd;
    	
    	$client_info->where($condition)
    	->update(['Cname'=>	$Cname_upd,'Csex'=>$Csex_upd,'Ccomp'=>$Ccomp_upd,'Cposi'=>$Cposi_upd,'Ctel'=>$Ctel_upd]);
    	
    	$this->success('修改成功','User/user_in');} 	
    	else{$this->error('输入错误，操作失败',	'User/user_in');}
    }
    
    public function ser()
    {
    	$client_info = new client_info;
    	$Cname_ser = Request::instance()->param('Cname_ser');
    	
    	if($Cname_ser != null){
    		
    	$condition['Cname'] = $Cname_ser;
    	$Ci = $client_info->where($condition)->select();
    	
    	if(0==count($Ci)){
    		$this->error('查无此人',	'User/user_in');
    	}
    	else{
        $Csex_ser = $Ci[0]['Csex'];
    	$Ccomp_ser= $Ci[0]['Ccomp'];
    	$Cposi_ser= $Ci[0]['Cposi'];
    	$Ctel_ser= $Ci[0]['Ctel'];
    	$view = new View();
    	
    	$view->assign('Csex_ser',$Ci[0]['Csex']);								
    	$view->assign('Ccomp_ser',$Ci[0]['Ccomp']);
    	$view->assign('Cposi_ser',$Ci[0]['Cposi']);
    	$view->assign('Ctel_ser',$Ci[0]['Ctel']);
    	
    	return	$view->fetch();}}
    	else{$this->error('输入错误，操作失败',	'User/user_in');}
    }
}
