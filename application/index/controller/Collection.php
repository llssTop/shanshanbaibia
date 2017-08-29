<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;
use think\Request;
use app\index\model\Comment;
use app\index\model\Order;
class Collection extends Controller
{
	protected $comment;
	protected $order;
	public function _initialize()
	{
		$this->comment = new Comment;
		$this->order = new Order;
	}
	public function collection()
	{
		return $this->fetch();
	}
	public function comment()
	{
		return $this->fetch();
	}
	public function commentlist(Request $request)
	{
		$orid = $request->param('orderid');
		//dump($orid);
		$result = $this->order->checkCom($orid);
		//dump($result);die;
		return $this->fetch();
	}
	public function foot()
	{
		return $this->fetch();
	}
	public function logistics()
	{
		return $this->fetch();
	}
	public function news()
	{
		return $this->fetch();
	}
}