<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
class User extends Auth 
{
	protected $is_login = ['*'];
	public function user_list()
	{
		return $this->fetch();
	}
	public function membergrading()
	{
		return $this->fetch();
	}
	public function integration()
	{
		return $this->fetch();
	}
}