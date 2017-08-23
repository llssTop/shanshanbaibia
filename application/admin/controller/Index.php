<?php
namespace app\admin\controller;
use app\admin\controller\Auth;
class Index extends Auth
{
	protected $is_login = ['*'];
   public function index()
   {
   	// var_dump(session('admin'));
        return $this->fetch();
   }
   public function home()
   {
        return $this->fetch();
   }
}
