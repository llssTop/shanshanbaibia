<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;
use think\Request;
use think\Session;

use app\index\model\Cart;

class Order extends Controller
{
	protected $cart;
	public function _initialize()
	{
		parent:: _initialize();
		$this->cart = new Cart;
	}
	public function shopcart(Request $request)
	{
		$uid = session('userid');
		$count = $this->cart->cartcount($uid);
		session('cartsum',"$count");
		$this->assign('countnum',$count);
		return $this->fetch();
	}
	public function addShopnum(Request $request)
	{
		$num = $_POST['num'];
		$goodsid = $_POST['goodsid'];
		$data = $_POST;
		//未登录状态加入购物车
		if(empty(session('userid'))){
			$arr =[$goodsid=>$data];
			session("$goodsid",$arr);
			$a = $request->session();
			dump($a);die;
			foreach ($a as $key => $value) {
				dump($key);
				dump($value);die;
			}
		} else{
			// 登录状态加入购物车
			$a = $request->cookie();
			// 拿到cookie里面的值，判断cookie 里面是否为空，如果为不为空就行比较，为空就直接进行新传来的值，与数据库
			// 里面的数据进行比较。循环遍历cookie里面的值,可以将购物车里面的商品数量统计出来存到session
			// 里面，然后分布到layout页面。
			if(!empty($a)){
				foreach ($a as $key => $value) {
					//判断如果在数据库里面能找到当前的商品id 让商品的数量增加。
					$re = $this->cart->checkSid($key);
					if($re){
						// 更新数据库的sid 的 count 数量。
						$cartnum = $this->cart->updateShopNum($key);
						//dump($cartnum);
					} else{
						//将值插入到数据库，新增一个
						$re = $this->cart->addShop();
					}

					
				}
			} else{
				
			}
			$uid = session('userid');
			$addCart = $this->cart->addShopCart($data);

		}
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
	public function change()
	{
		return $this->fetch();
	}
}