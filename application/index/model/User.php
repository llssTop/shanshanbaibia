<?php
namespace app\index\model;
use think\Model;
use think\Db;
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
		 $pwd = $data['pwd'];
		 $repwd = $data['repwd'];
		 $regip = $_SERVER['REMOTE_ADDR'];
		 if($regip == '::1'){
		 	$regip = '127.0.0.1';
		 }
		 $regip= ip2long($regip);
		 $regtime = time();
		 $updatetime = time();
		 $userInfo = new User;
		 $userInfo->data(['uname'=>"$uname",'pwd'=>"$pwd",'phone'=>"$phone",'regip'=>"$regip",'regtime'=>"$regtime",'updatetime'=>"$updatetime"]);
		 $result =  $userInfo->save();
		 if(strcasecmp($pwd, $repwd)!=0){
		 	return false;
		 }else{
			return $result;
		 } 
	}
}