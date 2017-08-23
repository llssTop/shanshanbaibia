<?php
namespace app\admin\Controller;
use app\admin\model\Auth;
use think\Controller;
use think\Validate;
class Auth extends Controller 
{
	protected $is_login = [''];
	public function _initialize()
	{
		if(!$this->checklogin() && $this->is_login[0] == '*')
		{
			$this->error('您还未登录，请先登录',url('admin/auth/login'));
		}
	}
	public function checklogin()
	{
		return session('?admin');
	}
	public function login()
	{
		return $this->fetch();
	}
	public function dologin(Auth $auth)
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
			session('admin', $info);
			$this->success('登录成功','admin/index/index');
		}else{
			$this->error('密码错误');
		}
	}
	/*public function checkusername(Auth $auth){
		$name = $_POST['name'];
		$re = $auth->checkusernameModle($name);
		if($re){
			echo json_encode('存在');
		}else{
			echo json_encode('不存在');
		}
	}*/
	public function loginout()
	{
		session(null);
		$this->error('您还未登录，请先登录',url('admin/auth/login'));
	}
}