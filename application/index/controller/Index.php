<?php
namespace app\index\controller;
use think\Request;
use think\Controller;
use think\Validate;
use app\index\model\Details;
use app\index\model\Category;
class Index extends controller
{
	protected $category;
	protected $details;
	public function _initialize()
	{
		parent:: _initialize();
		$this->category = new Category;
		$this->details = new Details;

	}
	public function index(Request $request)
	{
		$re = $this->category->list();
		$small =$this->category->smallList();
		$litter =$this->category->litterList();
		$alitter =$this->category->alitterList();
		// 相关的食品的详细信息
		$detailsInfo = $this->details->checkDetail();
		//dump($detailsInfo);die;
		if($detailsInfo){
			$this->assign('detInfoma',$detailsInfo);
		}
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
