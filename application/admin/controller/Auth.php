<?php
namespace app\admin\Controller;
use app\admin\model\Auser;
use think\Controller;
use think\Validate;
use app\admin\model\Role;
use app\admin\model\Connect;
use think\Db;
use think\Request;
class Auth extends Controller 
{
	protected $is_login = [''];
	public function _initialize()
	{
		if(!$this->checklogin() && $this->is_login[0] == '*')
		{
			$this->error('您还未登录，请先登录',url('admin/auth/login'));
		}
		/*$username = session('admin')['username'];
		if(!empty($username)&&$username!=='admin'){
				$rolenum = Db::query("select rp.nid from snacks_auser as a,snacks_role as r,snacks_connect as c,snacks_roleplay as rp where a.id=c.uid and 
	        r.rid=c.rid and r.rid=rp.rid and a.username='$username'");
				if(!empty($rolenum)){
					$nid = $rolenum['0']['nid'];
			        $quanxian = Db::query("select route from snacks_node where nid in ($nid)");
			        $authinfo = strtolower(Request::instance()->controller());
					$name = strtolower(Request::instance()->action());
					$acting = 'admin/' . $authinfo . '/' .$name;
					if(!in_array($acting,$quanxian))
					{
						$this->error('没有权限访问');
						exit;
					}
				}
		}	 */
	}
	public function checklogin()
	{
		return session('?admin');
	}
	public function login()
	{
		return $this->fetch();
	}
	public function dologin(Auser $auth)
	{
		$validate = new Validate([
			'captcha|验证码'=>'require|captcha'
			]);
		$data = [
			'captcha' => $this->request->param('code'),
		];
		if(!$validate->check($data))
		{
			$this->error('验证码错误');
		}

		$info = $auth->checkusernameModle();
		if(!$info){
			$this->error('用户不存在');
			exit;
		}
		$userinfo = $auth->checkpwdModel($info);
		if($userinfo){
			$user = new Auser;
			$username = $_POST['username'];
			$user->save([
				'logintime'=>time(),
				],['username'=>$username]);
			$info = $user->checkusernameModle();
			session('admin', $info);
			$this->success('登录成功','admin/index/index');
		}else{
			$this->error('密码错误');
		}
	}
	public function loginout()
	{
		session(null);
		$this->error('您还未登录，请先登录',url('admin/auth/login'));
	}
}