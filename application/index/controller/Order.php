<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;
use think\Request;
use think\Session;
use app\index\model\Cart;
use app\index\model\Address;
use app\index\model\Order as OrderModel;
class Order extends Controller
{
	protected $cart;
	protected $order;
	public function _initialize()
	{
		parent:: _initialize();
		$this->cart = new Cart;
		$this->order = new OrderModel;
	}
	public function shopcart(Request $request)
	{
		$uid = session('userid');
		if(!empty($uid)){
			$count = $this->cart->cartcount();
			
			$shopsum = $this->cart->selectDetail($uid);
			//dump($shopsum);die;
			session('cartsum',$count);
			$this->assign('countnum',$count);
			$this->assign('shopsum',$shopsum);
		}
		return $this->fetch();
	}
	public function addShopnum(Request $request)
	{
		$num = $_POST['num'];
		$gsid = $_POST['goodsid'];
		//用户没有登录的情况对购物车的操作
		if(empty(session('userid'))){
			//第一次点击判断购物车是否为空
			if(empty(session('gwc'))){
				// 将pos 过来的值 存储到数组里面
				$data[]= $_POST;
				// 将目前的数组存到session 里面
				session('gwc',$data);
			}else {
				$arr = session('gwc');
				// 不为空的时候
				//dump($arr);die;
				foreach ($arr as $key => $value) {
					//商品id 存在的话，数量增加
					if($gsid == $value['goodsid']){
						$arr[$key]['num']++;
						session('gwc',$arr); // 重新arr 数组里面进行压值，搞清楚数组
					}else{
						// 将session 里面的值重新压入到数组
						$arr[] = $_POST;
						session('gwc',$arr);
						$arr = session('gwc');
					} 
				}
			}
			$arr = session('gwc');
			$zongshu =count($arr);
			session('cartsum',"$zongshu");
		}  // 登录状态加入购物车
		else{
			// 登录状态加入购物车
			// 拿到session里面的值，判断session 里面是否为空，如果为不为空就行比较，为空就直接进行新传来的值，与数据库
			// 里面的数据进行比较。循环遍历session里面的值,可以将购物车里面的商品数量统计出来存到session
			// 里面，然后分布到layout页面。
			// dump($arr);die;
			$arr = session('gwc');
			//dump($arr);die;
			if(!empty($arr)){
				foreach ($arr as $k => $value) {
					//判断如果在数据库里面能找到当前的商品id 让商品的数量增加。
					$goosid = $value['goodsid'];
					$zong = $value['num']+1;
					$re = $this->cart->checkSid($goosid);
					if($re){
						// 更新数据库的sid 的 count 数量。
						$cartnum = $this->cart->updateShopNum($goosid,$zong);
						//dump($cartnum);die;
					} else{
						//将值插入到数据库，新增一个
						$re = $this->cart->addShop($goosid,$zong);
					}	
				}
			} // session 为空直接对购物车进行操作。
			else{
				$re = $this->cart->checkSid($gsid);
				if($re){
					$num = $re['countnum'] + $num;
					$cartnum = $this->cart->updateShopNum($gsid,$num);
				}else{
					$re = $this->cart->addShop($gsid,$num);
				}
			}
			$zongshu  = $this->cart->cartcount();
			session('cartsum',"$zongshu");
		}
	}
	public function succ()
	{
		return $this->fetch();
	}
	// 当前用户的订单查询
	public function order()
	{
		$result = $this->order->checkOrder();
		if($result)
		{
			for($i = 0; $i < count($result); $i++){
			//往数组里面添加一个字段
			//$arr = $result[$i]['']
			$result[$i]['shop_name'] = $this->order->selectshop($result[$i]['sid']);
			$result[$i]['amountnum'] = explode(',',$result[$i]['amount']);
		}
			$this->assign('result',$result);
		}
		
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
	public function orderstatus()
	{
		$oid = $_POST['oid'];
		$updatestatus = $this->order->upstatus($oid);
	}
	public function orderdetial(Request $request)
	{
	
		$data = $_POST;
		$ordercode = $_SERVER['REMOTE_ADDR'];
		if($ordercode=='::1'){
			$ordercode = '127.0.0.1';
		}
		
		$ordercode = ip2long($ordercode);
	
		$time = time();
		
		$ordercode =substr($ordercode,0,4);
		$ordercode .= $time;
		
		$result = $this->order->addorder($data,$ordercode);
		if($result){
			echo json_encode(['errcode'=>1 ,'info'=>'订单成功']);
				
			} else {
			 echo json_encode(['errcode'=>0 ,'info'=>'订单失败']);
		}
		
	}
}