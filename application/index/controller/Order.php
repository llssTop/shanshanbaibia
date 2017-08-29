<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;
use think\Request;
use think\Session;
use app\index\model\Cart;
use app\index\model\Address;
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
		if(!empty($uid)){
			$count = $this->cart->cartcount($uid);
			$sumcart = $this->cart->shopcartnum($uid);
			$shopsum = $this->cart->selectDetail($uid);
			//dump($shopsum);die;
			session('cartsum',"$count");
			$this->assign('countnum',$count);
			$this->assign('shopsum',$shopsum);
		}
		return $this->fetch();
	}
	public function addShopnum(Request $request)
	{
		$num = $_POST['num'];
		$gsid = $_POST['goodsid'];
		//用户没有登录的情况对购物车的操作进行的相关处理
		/*if(empty(session('userid'))){
			//第一次点击判断购物车是否为空
			if(empty(session('gwc'))){
				// 将当前的数据存储到session 里面
				$data = [$_POST];
				session('gwc',$data);
			}else {
				$arr = session('gwc');
				// 不为空的时候
				foreach ($arr as $key => $value) {
					//商品id 存在的话，数量增加
					if($gsid == $value['goodsid']){
						$arr[$key]['num']++;
						session('gwc',$arr);
					}else{
						$str = [$_POST];
						$num[] = $str;
						session('gwc',$num);
					} 
				}
			}
			$arr = session('gwc');

			session('cartsum',"$count");
		} else{
			// 登录状态加入购物车
			// 拿到session里面的值，判断session 里面是否为空，如果为不为空就行比较，为空就直接进行新传来的值，与数据库
			// 里面的数据进行比较。循环遍历session里面的值,可以将购物车里面的商品数量统计出来存到session
			// 里面，然后分布到layout页面。
			if(!empty($arr)){
				foreach ($arr as $k => $value) {
					//判断如果在数据库里面能找到当前的商品id 让商品的数量增加。
					$key = $value['goodsid'];
					$num = $value['num'];
					$re = $this->cart->checkSid($key);
					if($re){
						// 更新数据库的sid 的 count 数量。
						$cartnum = $this->cart->updateShopNum($key);
						//dump($cartnum);
					} else{
						//将值插入到数据库，新增一个
						$re = $this->cart-> addShop($key,$num);
					}	
				}
			} else{
				$re = $this->cart->addShop($gsid,$num);
			}
		}*/
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
	public function pay(Address $address)
	{
		$result = $address->checkAddress();
		$this->assign('result',$result);
		return $this->fetch();
	}
	public function change()
	{
		return $this->fetch();
	}
}