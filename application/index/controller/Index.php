<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use think\Validate;
class Index extends controller{
	public function index() {
		return $this->fetch('index');
	}
	public function search()
	{
		return $this->fetch();
	}
}
