<?php
namespace app\index\model;
use think\Model;
use think\Db;
use think\Session;
class User extends Model
{
	public function checkinfo($uname)
	{
		$info = Db::table('snacks_user')->where('uname', "$uname")->find();
		return $info;
	}
	public  function checkUserInfo($uname)
	{
		$userInfo = Db::name('user')->where('uname',"$uname")->find(); 
		return $userInfo;
	}
	public function insertData($data)
	{
		 $uname = $data['uname'];
		 $phone = $data['tel'];
		 $pwd = md5($data['pwd']);
		 $repwd = $data['repwd'];
		 $regip = $_SERVER['REMOTE_ADDR'];
		 if($regip == '::1'){
		 	$regip = '127.0.0.1';
		 }
		 $regip= ip2long($regip);
		 $userInfo = new User;
		 $userInfo->data(
		 	[
		 		'uname' => "$uname",
			 	'pwd' => "$pwd",
			 	'phone' => "$phone",
			 	'regip' => "$regip",
			 	
		 	]);
		$result =  $userInfo->save();
		if($result){
			return $result;
		} else{ 
			return false;
		}
		
	}
	// 用户头像的修改
	public function imgInfo($path )
	{
		$uid = session('userid');
		//dump($uid);
		$result = Db::name('user')->where('uid',"$uid")->update(['avatar'=>"$path"]);
		//dump($result);
		if($result){
			return $result;
		}else {
			return false;
		}
	}
	public function checkDetail($uid)
	{
		$result = Db::name('user')->where('uid',$uid)->find();
		if($result){
			return $result;
		}else {
			return false;
		}
	}
	public function changeInfo($data)
	{
		$uid = session('userid');
		$uname = $data['uname'];
		$sex = $data['sex'];
		$birthday = $data['result'];
		$phone = $data['phone'];
		$email = $data['email'];
		$result = Db::name('user')
		->where('uid',"$uid")
		->update(
			[
				'uname'=>"$uname",
				'sex'=>"$sex",
				'birthday'=>"$birthday",
				'phone'=>"$phone",
				'email'=>"$email"
			]);
		if($result){
			return $result;
		} else {
			return false;
		}
	}
	public function updatePhone($phoneNum, $uid)
	{
		$result = Db::name('user')->where('uid',"$uid")->update(['phone'=>"$phoneNum"]);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
}