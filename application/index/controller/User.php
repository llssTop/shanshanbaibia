<?php
namespace app\index\controller;
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
	public function checkVert(Request $request)
	{
		if (true !== $this->validate($request->param(),['code|验证码'=>'require|captcha'
			])) {
					echo json_encode(['errcode'=>1 ,'info'=>'验证码正确']);
				} else {
					echo json_encode(['errcode'=>0 ,'info'=>'验证码错误']);
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
    /**
     * tp5邮件
     * @param
     * @author staitc7 <static7@qq.com>
     * @return mixed
     */
  /*  public function email() {
        $toemail='static7@qq.com';
        $name='static7';
        $subject='QQ邮件发送测试';
        $content='恭喜你，邮件测试成功。';
        dump(send_mail($toemail,$name,$subject,$content));
    }*/
    public function changepwd()//发送邮件来修改密码
	{
	    if(isset($_POST['submit']))
	    {
	        if(SendMail($_POST['mail'],$_POST['title'],$_POST['content'])){
	        	 $this->success('发送成功！');
	        	}else {
	        		$this->error('发送失败');
	        	}
	    }
	 }
}