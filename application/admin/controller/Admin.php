<?php
namespace app\admin\controller;
use app\admin\controller\Auth;
class Admin extends Auth
{
	protected $is_login = [*];
	public function index()
	{
		return $this->fetch();
	}
}