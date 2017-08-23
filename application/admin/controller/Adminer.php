<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
class Adminer extends Auth
{
	protected $is_login = ['*'];
	public function admin_Competence()
	{
		return $this->fetch();
	}
	public function admin_info()
	{
		return $this->fetch();
	}
	public function administrator()
	{
		return $this->fetch();
	}
}