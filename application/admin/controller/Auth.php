<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
class Auth extends Controller {
	protected $is_login = [''];
	public function _initialize() {
		if (!$this->checklogin() && $this->is_login[0] == '*') {
			$this->error('您还没有登录，请先登录', url('admin/auth/login'));
		}
	}
	public function checklogin() {
		return session('?admin');
		//判断session里面存储是否有值
	}
	public function login() {
		return $this->fetch();
	}
	public function dologin() {
		// 对登录进行处理
		$info = User::where(['nickname' => input('name')])->find();
		if ($info) {
			session('admin', $info->toArray());
			$this->success('成功', url('admin/admin/index'));
		} else {
			$this->error('您还没有登录，请先登录', url('admin/auth/login'));
		}
	}
	public function loginout() {
		session(null);
		$this->error('退出登录成功', url('admin/auth/login'));
	}
}
