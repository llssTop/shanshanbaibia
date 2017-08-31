<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
use app\admin\model\Order as OrderModel;
use app\admin\model\Details;
use think\Db;
use think\Request;
class Order extends Auth 
{
	protected $is_login = ['*'];
	public function amounts()
	{
		$order = new OrderModel;
		$re = $order->selectdata(4);
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function orderchart()
	{
		return $this->fetch();
	}
	public function order_handling(Request $request)
	{
		$order = new OrderModel;
		$status = empty($request->param('status'))? '%' : $request->param('status');
		$list = $order->selectdata($status);
		if(!empty($list))
		{
			$details = new Details;
			foreach($list as $k=>$v)
			{
				$list[$k]['status'] = $order->getStatusAttr($v['status']);
				$arr = explode(',',$list[$k]['sid']);
				foreach($arr as $k1=>$v1)
				{
					$list1[$v['orderid']][] = $details->detailInfo($v1);
				}
			}
			$this->assign('list1',$list1);
			$this->assign('list',$list);
		}
		
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
	public function refundcon()
	{
		return $this->fetch();
	}
	public function tijiao(Request $request)
	{
		$order = new OrderModel;
		$details = new Details;
		$deliver = $request->param('deliver');
		$oid = $request->param('oid');
		$code = $request->param('code');
		//先进行商品的减少，在更新订单状态
		$arr = $order->where('orderid',$oid)->column('sid','amount');
	/*	dump($arr);die;*/
		//键是amount，值是sid
		foreach($arr as $k=>$v)
		{
			$k1 = explode(',',$k);$v1 = explode(',',$v);
			foreach($v1 as $ka=>$va)
			{
				dump($va);
				$stock = Db::name('details')->where('sid',$va)->value('stock');
				dump($stock);
				$newstock = $stock - $k1[$ka];
				dump($newstock);
				$re = Db::name('details')->where('sid',$va)->update(['stock'=>$newstock]);	
			}
		}
		$re = $order->save([
							'deliver'=>$deliver,
							'decode'=>$code,
							'status'=>3,
							'create_time'=>time()
							],['orderid'=>$oid]);
		if($re){
			return json(['errcode'=>1,'订单成功发货']);
		}else{
			return json(['errcode'=>0,'订单发货失败']);
		}
		
	}
}