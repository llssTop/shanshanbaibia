<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;
class Order extends Controller
{
	public function shopcart()
	{
		return $this->fetch();
	}
	public function succ()
	{
		return $this->fetch();
	}
	public function order()
	{
		return $this->fetch();
	}
	public function orderinfo()
	{
		return $this->fetch();
	}
	public function pay()
	{
		return $this->fetch();
	}
}