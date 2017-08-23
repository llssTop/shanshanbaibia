<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
class Advertising extends Auth 
{
	protected $is_login = ['*'];
	public function advertising()
	{
		return $this->fetch();
	}
	public function sort_ads()
	{
		return $this->fetch();
	}
}