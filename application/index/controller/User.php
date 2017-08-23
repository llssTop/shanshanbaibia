<?php
namespace app\index\controller;
use app\index\model\User as UserModel;
use think\Controller;
use think\Validate;
class User extends Controller
{
	protected $user;
	public function _initialize()
	{
		parent:: _initialize();
		$this->user = new UserModel;
	}
	public function information()
	{
		return $this->fetch();
	}
	public function login()
	{
		return $this->fetch();
	}
	public function register()
	{
		return $this->fetch();
	}
	public function email()
	{
		return $this->fetch();
	}
	public function phone()
	{
		return $this->fetch();
	}
	public function check(UserModel $usermodel)
	{
		$uname = $_POST['uname'];
		$userInfo = $usermodel->checkUserInfo($uname);
		if($userInfo){
			echo json_encode(['errcode'=>1 ,'info'=>'用户存在']);
		}else{
			echo json_encode(['errcode'=>0 ,'info'=>'不存在']);
		};
	}
	public function checkCode(Request $request)
	{
		if (true !== $this->validate($request->param(),['code|验证码'=>'require|captcha'
			])) {
					$this->error('验证码错误');
				} else {
					$this->success('验证码正确');
			}
	}
	public function doregister(UserModel $usermodel)
	{
		$data = $usermodel->insertData($_POST);
		if($data){
			$this->success('注册成功',url('index/index/index'));
		}else {
			$this->error('注册失败',url('index/user/register'));
		}
	} 
	public function dologin()
	{
        $uname = $_POST['uname'];
        $pwd = $_POST['pwd'];
		$userInfo = $this->user->checkinfo($uname);
		if($userInfo) {
			session('user',$userInfo['uname']);
			if(strcasecmp($pwd, $userInfo['pwd'])==0){
				$this->success('登录成功',url('index/index/index'));
			}
			$this->error('登录失败，请先登录',url('index/user/login'));
		}else{
			$this->error('登录失败，请先登录',url('index/user/login'));
		}
	}
	public function loginout()
	{
		session(null);
		$this->success('退出登录成功',url('index/user/login'));
	}
	public function address()
	{
		return $this->fetch();
	}
	public function bindphone()
	{
		return $this->fetch();
	}1
	public function safety()
	{
		return $this->fetch();
	}
	
}