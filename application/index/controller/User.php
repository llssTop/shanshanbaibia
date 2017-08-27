<?php
namespace app\index\controller;
use think\Smtp;
use app\index\model\User as UserModel;
use app\index\model\Address;
use think\Controller;
use think\Validate;
use think\Session;
use think\Request;
use think\Ucpaas;

class User extends Controller
{
	protected $user;
	protected $addre;
	public function _initialize()
	{
		parent:: _initialize();
		$this->user = new UserModel;
		$this->addre = new Address;
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
	public function checkVert(Request $request)
	{
		if (true !== $this->validate($request->param(),['code|验证码'=>'require|captcha'
			])) {
					echo json_encode(['errcode'=>0 ,'info'=>'验证码错误']);
				} else {
					echo json_encode(['errcode'=>1 ,'info'=>'验证码成功']);
			}
		/*	$validate = new Validate([
			'captcha|验证码'=>'require|captcha'
			]);
			$data = [
				'captcha' => input('code')
			];
			if (!$validate->check($data)) {
				dump($validate->getError());
			} else {
				dump('正确');
			}*/
	}
	public function doregister(UserModel $usermodel)
	{
		$data = $usermodel->insertData($_POST);
		if($data){
			session('username',$_POST['uname']);
			$this->success('注册成功',url('index/index/index'));
		}else {
			$this->error('注册失败',url('index/user/register'));
		}
	} 
	public function dologin()
	{
        $uname = $_POST['uname'];
        $pwd = md5($_POST['pwd']);
		$userInfo = $this->user->checkinfo($uname);
		if($userInfo) {
			//$arr = [];
			if(strcasecmp($pwd, $userInfo['pwd'])==0){
				/*foreach ($userInfo as $key => $value) {
					$arr[$key] = $value;
				}
				session('usrInfo',$arr);*/
				session('vip',$userInfo['vip']);
				session('grade',$userInfo['grade']);
				session('uname',$userInfo['uname']);
				session('uid',$userInfo['uid']);
				session('phone',$userInfo['phone']);
				Session::set('username',"$uname");
				session('avatar',$userInfo['avatar']);
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
	public function address(Address $address)
	{

		$result = $address->checkAddress();
		//dump($result);
		$this->assign('result',$result);
		return $this->fetch();
	}
	public function bindphone()
	{
		$phone = session('phone');
		$this->assign('phone',$phone);
		return $this->fetch();
	}
	public function safety()
	{
		$vip = session('vip');
		$avatar = session('avatar');
		$this->assign('vip',$vip);
		$this->assign('avatar',$avatar);
		return $this->fetch();
	}
	//头像上传
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
			//session('avatar',$imgPath);
			if($imgData){
				$this->success('头像修改成功',url('index/user/information'));
			}
		}else{
		// 上传失败获取错误信息
		   echo $file->getError();
		}
	}
	public function upInfo()
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
	// 新增收货地址
	public function save(Address $address)
	{
		$result = $address->addAddress($_POST);
		if($result){
			echo json_encode(['errcode'=>1 ,'info'=>'成功']);
		} else{
			echo json_encode(['errcode'=>0 ,'info'=>'失败']);
		}
	}
	// 用户删除地址
	public function deleteInfo()
	{
		$aid = $_GET['aid'];
		$result = $this->addre->delInfo($aid);
		if($result){
			$this->success('成功',url('index/user/address'));
		} else{
			$this->error('失败',url('index/user/address'));
		}
	}
	public function dosafety(){
	    //初始化必填
	    $options['accountsid']='4d0cea011be406a1c05d1863df30a28b';
	    $options['token']='e53d3077cab7a59ccc45b9f9803b0f2b';
	    $str = '12345678900987654321';
	    $str1 = substr(str_shuffle($str),0,4);
	    //$_SESSION['phonecode'] = $str1;
	    session('phonecode',$str1);
	    //初始化 $options必填
	    $ucpass = new Ucpaas($options);
	    //开发者账号信息查询默认为json或xml
	    //短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
	    $appId = "d3083be7d515445499d357e607842227";
	    $to = $_POST['phone'];
	    $templateId = "102268";
	    $param=$str1;
	    echo json_encode(array('notice'=>$str1));
	   // $ucpass->templateSMS($appId,$to,$templateId,$param);
    }
    public function upPhone()
    {
    	$phoneNum = $_POST['newPhone'];
    	$uid = session('userid');
    	$result = $this->user->updatePhone($phoneNum,$uid);
    	if($result){
    		echo json_encode(['errcode'=>1 ,'info'=>'手机变更成功']);
    	}else{
    		echo json_encode(['errcode'=>0 ,'info'=>'手机号变更失败']);
    	}
    }
    public function checkemail()
    {
    	//var_dump($_POST);die;
    	$smtpserver = "smtp.163.com";//SMTP服务器
		$smtpserverport =25;//SMTP服务器端口
		$smtpusermail = "18317775325@163.com";//SMTP服务器的用户邮箱
		$smtpemailto = $_POST['toemail'];//发送给谁
		// $smtpemailto = '19409721881@qq.com';
		$smtpuser = "18317775325";//SMTP服务器的用户帐号，注：部分邮箱只需@前面的用户名
		$smtppass = "llssTop66";//SMTP服务器的用户密码
		$mailtitle = $_POST['title'];//
		// $mailtitle = 'asdfad';
		$mailcontent = "{$_POST['content']}";
	
		$mailtype = "TXT";//邮件格式（HTML/TXT）,TXT为文本邮件
		//************************ 配置信息 ****************************
		$smtp = new Smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
		$smtp->debug = true;//是否显示发送的调试信息
		$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
		if($state == ""){
			//echo json_encode(['errcode'=>0 ,'info'=>'发送失败']);
			$this->success('发送失败');
		}else{
			$email = $_POST['toemail'];
			$ok = $this->user->updateEmail($email);
			$this->error('发送成功');
			//echo json_encode(['errcode'=>1 ,'info'=>'发送成功']);
		}
    }
}