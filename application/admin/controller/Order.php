<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
class Order extends Auth 
{
	protected $is_login = ['*'];
	public function amounts()
	{
		return $this->fetch();
	}
	public function orderchart()
	{
		return $this->fetch();
	}
	public function order_handling()
	{
		return $this->fetch();
	}
	public function orderform()
	{
		return $this->fetch();
	}
	public function refund()
	{
		return $this->fetch();
	}
	public function transaction()
	{
		return $this->fetch();
	}
	public function orderdetailed()
	{
		return $this->fetch();
	}
}