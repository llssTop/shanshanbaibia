<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
use app\admin\model\User as UserModel;
use think\Db;
use think\Request;
class User extends Auth 
{
	protected $is_login = ['*'];
	public function user_list()
	{
		$list =Db::name('user')->select();
		$user = new UserModel;
		//操作 list数组，只给￥v改值，并不能改变该数组
		foreach($list as $ke=>$v)
		{
			$list[$ke]['sex'] = $user->getSexAttr($v['sex']);
			$list[$ke]['vip'] = $user->getVipAttr($v['vip']);
		}
		$this->assign('list',$list);
		return $this->fetch();
	}
	public function membergrading()
	{
		return $this->fetch();
	}
	public function integration()
	{
		return $this->fetch();
	}
	public function jinzhi(Request $request)
	{
		$uid = $request->param('uid');
		$user = new UserModel;
		$re = $user->forbiten($uid);
		if($re){
			echo "<script>alert('禁止成功');history.go(-1);</script>";
		}else{
			echo "<script>alert('设置失败');history.back();</script>";
		}
	}
	public function kaiqi(Request $request)
	{
		$uid = $request->param('uid');
		$user = new UserModel;
		$re = $user->kai($uid);
		if($re){
			echo "<script>alert('解禁成功');history.go(-1)</script>";
		}else{
			echo "<script>alert('设置失败');history.go(-1)</script>";
		}
	}
}