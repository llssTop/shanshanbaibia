<?php
namespace app\admin\Model;
use think\Model;
use think\Db;
class Category extends Model
{
	public function list()
	{
		return Db::name('category')->where('isdel',0)->select();
	}

	public function addlist($id,$name)
	{//原则是各种不重名
		$re = Db::name('category')->where('cname',$name)->select();
		if(!empty($re))
		{
			return false;
		}
		$path = Db::name('category')->where('cid',$id)->find();//返回depth=》path
		$arr = explode(',', $path['path']);
		array_push($arr,$id);
		$newpath = implode(',',$arr);
		$depth = $path['depth'] + 1;
		$cate = new Category;
		$cate->data = ([
			'cname'=>$name,
			'pid'=>$id,
			'path'=>$newpath,
			'depth'=>$depth
			]);
		return $cate->save();
	}
	public function uplist($id,$name)
	{
		$re = Db::name('category')->where('cname',$name)->find();
		if($re !== null)
		{
			return false;
		}
		$up = new Category;
		$res = $up->save([
			'cname'=>$name],['cid'=>$id]);
		return $res;
	}
	public function dellist($id)
	{
		return Db::name('category')->where('cid',$id)->setField('isdel',1);	
	}
	public function zengtong($cid, $name)
	{
		$re = Db::name('category')->where('cid',$cid)->find();
		$cname = $name;
		$pid = $re['pid'];
		$path = $re['path'];
		$depth = $re['depth'];
		$cate = new Category;
		$cate->data = ([
			'cname'=>$name,
			'pid' => $pid,
			'path'=> $path,
			'depth' => $depth
		]);
		return $cate->save();
	} 
	public function selectmin()
	{
		/*$arr = [];
		$re = Db::name('category')->where('pid',0)->where('isdel',0)->select();
		foreach($re as $val)
		{
			$re1 = Db::name('category')->where('isdel',0)->select();
			foreach($re1 as $v1)
			{
				if(strpos($v1['path'], (string)$val['cid']))
				{
						$arr[$val['cid']][] = $v1['cid'];
				}
			}
		}
		
		foreach($arr as $k=>$v)
		{
			$string = implode(',',$v);
			$arr1[$k] = Db::query("select cid from snacks_category where cid in ($string) and depth  = (select max(depth) from snacks_category where cid in ($string))");
			
		}
		return $arr1;
	}*/
		return Db::name('category')->where('depth',3)->select();
		}

}