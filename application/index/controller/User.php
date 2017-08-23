<?php
namespace app\index\controller;
use app\index\model\User as UserModel;
use think\Controller;
use think\Validate;
use think\Session;
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
		$uid = session('userid');
		$data = $this->user->checkDetail($uid);
		$this->assign('data',$data);
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
			$arr = [];
			if(strcasecmp($pwd, $userInfo['pwd'])==0){
				/*foreach ($userInfo as $key => $value) {
					$arr[$key] = $value;
				}
				session('usrInfo',$arr);*/
				session('vip',$userInfo['vip']);
				session('grade',$userInfo['grade']);
				session('uname',$userInfo['uname']);
				session('uid',$userInfo['uid']);
				Session::set('username',"$uname");
				//var_dump(Session::get('username'));
				$uid = $userInfo['uid'];
				Session::set('userid',"$uid");
				//var_dump(Session::get('userid'));
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
	}
	public function safety()
	{
		return $this->fetch();
	}
	public function upload()
	{
		// 获取表单上传文件 例如上传了001.jpg
		$file = request()->file('image');
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
			$imgPath =  $info->getSaveName();
			$imgPath = str_replace('\\', '/', $imgPath);
			$imgData = $this->user->imgInfo($imgPath);
			if($imgData){
				$this->success('头像修改成功',url('index/user/information'));
			}
		}else{
		// 上传失败获取错误信息
		   echo $file->getError();
		}
	}
	public function changInfo()
	{
		if(!empty($_POST)){
			$data = $_POST;
			$result = $this->user->changeInfo($data);
			if($result){
				echo json_encode(['errcode'=>1 ,'info'=>'成功']);
			} else{
				echo json_encode(['errcode'=>0 ,'info'=>'失败']);
			}
		}
	}
}