<?php
namespace app\admin\controller;
use app\admin\controller\Auth;
use think\Db;
class Index extends Auth
{
	protected $is_login = ['*'];
   public function index()
   {
      $username = session('admin')['username'];
      if($username !== 'admin'){
        $rolenum = Db::query("select rp.nid from snacks_auser as a,snacks_role as r,snacks_connect as c,snacks_roleplay as rp where a.id=c.uid and 
        r.rid=c.rid and r.rid=rp.rid and a.username='$username'");
        if(!empty($rolennum))
        {
           $nid = $rolenum['0']['nid'];
          $top = Db::query("select * from snacks_node where nid in ($nid) and pid=0");
          $mid= Db::query("select * from snacks_node where nid in ($nid) and pid>0");
          $action = Db::query("select * from snacks_node where nid in ($nid) and pid is null");
          $this->assign('top',$top);
          $this->assign('mid',$mid);
          $this->assign('action',$action);
        }else{
          $this->error('您无权访问',url('admin/auth/login'));
        }
       
      }
        return $this->fetch();
   }
   public function home()
   {
        return $this->fetch();
   }
}
