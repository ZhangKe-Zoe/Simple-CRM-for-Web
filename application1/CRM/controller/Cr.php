<?php
namespace app\CRM\controller;

use think\Controller;
use app\CRM\model\client_rela;
use think\Request;
use  think\View;
 
class Cr extends controller
{ 
	
    public function add()
    {  $client_rela = new client_rela;
    	
       $Cname_add = Request::instance()->param('Cname_add'); 
       $Ctend_add  = Request::instance()->param('Ctend_add'); 
       $Cproj_add = Request::instance()->param('Cproj_add'); 
       $Cpay_add = Request::instance()->param('Cpay_add');  
       
       if ($Cname_add != null){
       $client_rela->Cname = $Cname_add;
       $client_rela->Ctend  = $Ctend_add;
       $client_rela->Cproj = $Cproj_add;
       $client_rela->Cpay = $Cpay_add;
       
       $client_rela->save();
       
       $this->success('添加成功',	'User/user_in');}
       else{$this->error('输入错误，操作失败',	'User/user_in');}
       
    }
    
    public function del()
    {
    	$client_rela = new client_rela;
    	
    	$Cname_del = Request::instance()->param('Cname_del');
    	
    	if ($Cname_del != null){
    	client_rela::where('Cname',$Cname_del)->delete();

    	$this->success('删除成功','User/user_in');}
    	else{$this->error('输入错误，操作失败',	'User/user_in');};
    	 	
    }
    
    public function upd()
    {
    	$client_rela = new client_rela;
    	
    	$Cname_upd = Request::instance()->param('Cname_upd'); 
        $Ctend_upd  = Request::instance()->param('Ctend_upd'); 
        $Cproj_upd = Request::instance()->param('Cproj_upd'); 
        $Cpay_upd = Request::instance()->param('Cpay_upd');  
        
        if ($Cname_upd != null){
        	
        $condition['Cname'] = $Cname_upd;
    	$client_rela->where($condition)
    	->update(['Cname'=>	$Cname_upd,'Ctend'=>$Ctend_upd,'Cproj'=>$Cproj_upd,'Cpay'=>$Cpay_upd]);
    	
    	$this->success('修改成功','User/user_in');}	
    	else{$this->error('输入错误，操作失败',	'User/user_in');};
    	
    }
    
    public function ser()
    {
    	$client_rela = new client_rela;
    	$Cname_ser = Request::instance()->param('Cname_ser');
    	
    	if ($Cname_ser != null){
    	$condition['Cname'] = $Cname_ser;
    	$Cr = $client_rela->where($condition)->select();
    	if(0==count($Cr)){
    		$this->error('查无此人',	'User/user_in');
    	}
    	else{
        $Ctend_ser = $Cr[0]['Ctend'];
    	$Cproj_ser= $Cr[0]['Cproj'];
    	$Cpay_ser= $Cr[0]['Cpay'];
    	
    	$view = new View();
    	
    	$view->assign('Ctend_ser',$Cr[0]['Ctend']);								
    	$view->assign('Cproj_ser',$Cr[0]['Cproj']);
    	$view->assign('Cpay_ser',$Cr[0]['Cpay']);
    	
    	return	$view->fetch();}}
    	else{$this->error('输入错误，操作失败',	'User/user_in');};
    	
    }
}
