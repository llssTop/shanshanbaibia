<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
use app\admin\model\Comment;
use think\Model;
use think\Db;
use think\Session;
use think\Request;
class Message extends Auth
{
	protected $is_login = ['*'];
	public function feedback()
	{//用两个字段查出未评论的商品first为0和isreply=0
		$re = Db::query("select * from snacks_user,snacks_comment where snacks_user.uid=snacks_comment.userid and isreply=1");
		$con = new Comment;
		foreach($re as $k=>$va)
		{
			$re[$k]['status'] = $con->getStatusAttr($va['status']);
		}
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function guestbook()
	{
		$re = Db::query("select * from snacks_user,snacks_comment where snacks_user.uid=snacks_comment.userid and isreply=0 and first=0");
		$con = new Comment;
		foreach($re as $k=>$v)
		{
			$re[$k]['status'] = $con->getStatusAttr($v['status']);
		}
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function liuyan(Request $request)
	{
		$did = $request->param('did');
		$re = Db::query("select * from snacks_user,snacks_comment where snacks_user.uid=snacks_comment.userid and did=$did");
		$re = $re['0'];
		$con = new Comment;
		$re['status'] = $con->getStatusAttr($re['status']);
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function doreply(Request $request)
	{
		$did = $request->param('did');
		$con = $request->param('con');
		$liu = Db::name('comment')->where('did',$did)->find();
		$arr['create_time'] = time();
		$arr['first'] = 1;
		$arr['content'] = $con;
		$arr['oid'] = $liu['oid'];
		$arr['sid'] = $liu['sid'];
		$arr['userid'] = $liu['userid'];
		$arr['status'] = $liu['status'];
		$arr['isreply'] = 1;
		$res = Db::name('comment')->insert($arr);
		$res1 = Db::name('comment')->where('did',$did)->update(['isreply'=>1]);
		return json(['errcode'=>1]);
	}
}