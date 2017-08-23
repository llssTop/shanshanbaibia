<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
class Store extends Auth 
{
	protected $is_login = ['*'];
	public function shoplist()
	{
		return $this->fetch();
	}
	public function shopaudit()
	{
		return $this->fetch();
	}
}