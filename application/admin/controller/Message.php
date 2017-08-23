<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
class Message extends Auth
{
	protected $is_login = ['*'];
	public function feedback()
	{
		return $this->fetch();
	}
	public function guestbook()
	{
		return $this->fetch();
	}
}