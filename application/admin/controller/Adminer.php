<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
use app\admin\model\Auser;
use app\admin\model\Role;
use think\Model;
use think\Request;
use app\admin\model\Connect;
use think\Db;
use app\admin\model\Node;
use think\Paginator;
use app\admin\model\Roleplay;
class Adminer extends Auth
{
	protected $is_login = ['*'];
	public function admin_Competence()
	{
		$re = Db::name('node')->paginate(7);
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function modify(Request $request)
	{
		$rid = $request->param('rid');
		$rname = $request->param('rname');
		$top = Db::name('node')->where('pid',0)->select();
		/*$had = Db::name('roleplay')->where('rid',$rid)->value('nid');*/
		$mid = Db::query("select * from snacks_node where pid >0");
		$idea = Db::query("select * from snacks_node where pid is null");
		/*$this->assign('had',$had);*/
		$this->assign('idea',$idea);
		$this->assign('mid',$mid);
		$this->assign('top',$top);
		$this->assign('rid',$rid);
		$this->assign('rname',$rname);
		return $this->fetch();
	}
	public function admin_Reflection()
	{
		$roles = Db::name('role')->select();
		$this->assign('roles',$roles);
		return $this->fetch();
	}
	public function admin_info()
	{
		$re = session('admin');
		$this->assign('re',$re);
		$id = $re['id'];
		$re1 = Db::query("select rname from snacks_role as r,snacks_connect as c,snacks_auser as a where a.id=c.uid and c.rid=r.rid and a.id=$id");
		$re2 = Db::name('auser')->select();
		$this->assign('re1',$re1);
		$this->assign('re2',$re2);
		return $this->fetch();
	}
	public function administrator(Request $request)
	{

		$role = new Role;
		$roles  = $role->sousuo();
		$rid = !empty($request->param('rid'))?$request->param('rid'):'%';
		$auth = new Auser;
		$re = $auth->chakan($rid);
		$this->assign('roles',$roles);
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function competence(Request $request)
	{
		$nid = $request->param('nid');
		$name = Db::name('node')->where('nid',$nid)->find();
		$this->assign('name',$name);
		return $this->fetch();
	}
	public function addmember()
	{
		$auser = new Auser;
		if($auser->checkusernameModle())
		{
			$this->error('管理员已存在',url('admin/adminer/administrator'));
		}
		$rid = $_POST['adminrole'];
		$id = $auser->addcheng();
		if(!empty($id)){
			$con = new Connect;
			$re = $con->addlink($rid,$id);
			$this->success('加入成功',url('admin/adminer/administrator'));
		}else{
			$this->error('添加失败',url('admin/adminer/administrator'));
		}
	}
	public function checkpass(Request $request)
	{
		$user = new Auser;
		$uid = $request->param('uid');
		$pass = $request->param('pass');
		$new = $request->param('newpass');
		$newpass = md5($new);
		$re = Db::name('auser')->where('id',$uid)->find();
		$pass = md5($pass);
		if(strcasecmp($pass,$re['password']) == 0)
		{
			$re1 = $user->save(['password'=>$newpass],['id'=>$uid]);
			if($re1)
			{
				return json(['errcode'=>1]);
			}else{
				return json(['errcode'=>0]);
			}
		}
	}
	public function adminchange()
	{
		
		$id = $_GET['id'];
		$re1 = Db::query("select username from snacks_auser where id=$id");
		$re =Db::query("select username,snacks_connect.rid,rname from snacks_auser left join snacks_connect on id=uid left join snacks_role on snacks_connect.rid=snacks_role.rid where id=$id");
		$roles = Db::name('role')->select();
		$this->assign('roles',$roles);
		$this->assign('id',$id);
		$this->assign('re1',$re1);
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function uprole(Request $request)
	{
		$uid = $_POST['hid'];	
		if(isset($_POST['newbox']))
		{
			$check = $_POST['newbox'];
			$re = Db::query("delete from snacks_connect where uid=$uid");
			Db::name("connect")->data(['uid'=>$uid,'rid'=>$check])->
				insert();
			
			$this->success('修改成功',url('admin/adminer/administrator'));	
		}else{
			$this->error('未选择身份',url('admin/adminer/administrator'));
		}
	}
	public function addnode(Request $request)
	{
		$pname = $request->param('node');
		$route = $request->param('route');
		$pid = $request->param('sourse');
		$hid = $request->param('hid');
		$node = new Node;
		if(!empty($pid)){
			$node->data([
				'pname'=>$pname,
				'route'=>$route,
				'pid'=>$pid
			]);
		}else{
			$node->data([
				'pname'=>$pname,
				'route'=>$route
				]);
		}
		$node->save();
		if(!empty($node->nid))
		{
			$this->success('加入成功','admin/adminer/admin_competence');
		}else{
			$this->error('添加失败','admin/adminer/admin_competence');
		}
	}
	public function uproleplay(Request $request)
	{
		$rid = $request->param('rid');
		$box = $request->param('box');
		$box = rtrim($box,',');
		$re = Db::name("roleplay")->where('rid',$rid)->find();
		$roleplay = new Roleplay;
		if(!empty($re))
		{
			$res = $roleplay->save([
					'nid' => $box
				],['rid'=>$rid]);
		}else{
			$roleplay->data([
					'rid'=>$rid,
					'nid'=>$box
				]);
			$res = $roleplay->save();
		}
		if($res)
		{
			return json(['errcode'=>1]);
		}else{
			return json(['errcode'=>0]);
		}
	}
	public function checkinfo(Request $request)
	{
		$uid = $request->param('uid');
		$sex = $request->param('sex');
		$email = $request->param('email');
		dump($uid);dump($email);
	} 
}