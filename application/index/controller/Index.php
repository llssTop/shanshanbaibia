<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use think\Validate;

use app\index\model\Detail;
use app\index\model\Category;
class Index extends controller
{
	protected $category;
	
	public function _initialize()
	{
		parent:: _initialize();
		$this->category = new Category;

	}
	public function index(Request $request)
	{
		$re = $this->category->list();
		//$newarr = $this->GetTree($re,0);
		//dump($re);
		$small =$this->category->smallList();
		//dump($small);
		$litter =$this->category->litterList();
		$alitter =$this->category->alitterList();
		//$cid =$request->param('cid');
		/*dump($cid);die;
		$detailInfo = new Detail;
		$re*///sult = $detailInfo->seleDetail(); 
		$this->assign('newarr',$re);
		$this->assign('small',$small);
		$this->assign('litter',$litter);
		$this->assign('alitter',$alitter);	
		return $this->fetch();
		// 分类的相关查询
		// 一个表对应的两个表的查询，遍历主页的内容	
	}
	public function search()
	{
		return $this->fetch();
	}
	
	/*private function GetTree($arr, $pid) //step 是一个深度
	{
		global $tree;
		foreach($arr as $key=>$val){
			if($val['pid'] == $pid){
				$tree[]= $val;
				$this->GetTree($arr, $val['cid']);
			}
		}
		return $tree;
	}*/

}
