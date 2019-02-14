<?php
namespace app\CRM\controller;

use think\Controller;
use app\CRM\model\c_order;
use think\Request;
use  think\View;
 
class Rco extends controller
{ 
    public function add()
    {  $c_order = new c_order;
    	
       $Oname_add = Request::instance()->param('Oname_add'); 
       $Onum_add  = Request::instance()->param('Onum_add'); 
       $Ocli_add = Request::instance()->param('Ocli_add'); 
       $Odate_add = Request::instance()->param('Odate_add');  
       
       if ($Oname_add != null){
       $c_order->Oname = $Oname_add;
       $c_order->Onum  = $Onum_add;
       $c_order->Ocli = $Ocli_add;
       $c_order->Odate = $Odate_add;
       
       $c_order->save();
       
       $this->success('添加成功',	'User/root_in');}
       else{$this->error('输入错误，操作失败',	'User/root_in');}
    }
    
    public function del()
    {
    	$c_order = new c_order;
    	
    	$Oname_del = Request::instance()->param('Oname_del');
    	
    	if ($Oname_del != null){
    	c_order::where('Oname',$Oname_del)->delete();

    	$this->success('删除成功','User/root_in');}
    	
    	else{$this->error('输入错误，操作失败',	'User/root_in');}
    	 	
    }
    
    public function upd()
    {
    	$c_order = new c_order;
    	
    	$Oname_upd = Request::instance()->param('Oname_upd'); 
        $Onum_upd  = Request::instance()->param('Onum_upd'); 
        $Ocli_upd = Request::instance()->param('Ocli_upd'); 
        $Odate_upd = Request::instance()->param('Odate_upd');  
        
        if ($Oname_upd != null){
        $condition['Oname'] = $Oname_upd;
    	
    	$c_order->where($condition)
    	->update(['Oname'=>	$Oname_upd,'Onum'=>$Onum_upd,'Ocli'=>$Ocli_upd,'Odate'=>$Odate_upd]);
    	
    	$this->success('修改成功','User/root_in'); }
    	
    	else{$this->error('输入错误，操作失败',	'User/root_in');}
    	 	
    }
    
    public function ser()
    {
    	$c_order = new c_order;
    	$Oname_ser = Request::instance()->param('Oname_ser');
    	
    	if ($Oname_ser != null){
    		
    	$condition['Oname'] = $Oname_ser;
    	$Co = $c_order->where($condition)->select();
    	
    	if(0== count($Co)){
    		
    	$this->error('查无此单',	'User/user_in');
        
    	}
    	
    	else{$Onum_ser = $Co[0]['Onum'];
    	$Ocli_ser= $Co[0]['Ocli'];
    	$Odate_ser= $Co[0]['Odate'];
    	
    	$view = new View();
    	
    	$view->assign('Onum_ser',$Co[0]['Onum']);								
    	$view->assign('Ocli_ser',$Co[0]['Ocli']);
    	$view->assign('Odate_ser',$Co[0]['Odate']);
    	return	$view->fetch();}}
    	
    	else{$this->error('输入错误，操作失败',	'User/root_in');}
    }
}
