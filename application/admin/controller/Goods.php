<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
use app\admin\model\Details;
use app\admin\model\Category;
use think\Db;
use think\Request;
class Goods extends Auth
{
	protected $is_login = ['*'];
	public function brand_manage()
	{
		return $this->fetch();
	}
	public function category_manage(Category $cate)
	{
		$re = $cate->list();
		$newarr = $this->GetTree($re,0,0);
		$this->assign('newarr',$newarr);
		return $this->fetch();
	}
	private function GetTree($arr, $pid, $step)
	{
		global $tree;
		foreach($arr as $key=>$val){
			if($val['pid'] == $pid){
				$flg = str_repeat("&nbsp;&nbsp;&nbsp;—————",$step);
				$val['name'] = $flg.$val['cname'];
				$tree[] = $val;
				$this->GetTree($arr, $val['cid'],$step+1);
			}
		}
		return $tree;
	}
	public function products_list()
	{
		$detail  = new Details;
		$count = Db::name('details')->where('isshelf',0)->count();
		$list = Db::name('details')->where('isshelf',0)->paginate(4);
		$this->assign('count',$count);
		$this->assign('list',$list);
		return $this->fetch();
	}
	public function categoryadd(Request $request)
	{
		$cid = $request->param('cid');
		$cname = Db::name('category')->where('cid',$cid)->column('cname');
		$this->assign('cname',$cname[0]);
		return $this->fetch();
	}
	public function pictureadd(Request $request)
	{
		/*$re = Db::name('category')->where('pid',0)->select();
		$this->assign('re',$re);*/
		/*if(!empty($request->param('big')))
		{
			$cid1 = $request->param('big');
			$re1 = Db::name('category')->where('pid',$cid1)->select();
			$this->assign('re1',$re1);
			return $this->fetch();
			return json($re1);
		}*/
		$cate = new Category;
		$re = $cate->selectmin();
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function bigadd(Request $request)
	{
		$cid1 = $request->param('big');
		dump($cid1);
		$re1 = Db::name('category')->where('pid',$cid1)->select();
		$this->assign('re1',$re1);
		echo $this->fetch('/goods/pictureadd');
	}
	public function addbrand()
	{
		return $this->fetch();
	}
	public function upload(Details $de)
	{
		/*dump($info);*/
		$file1 = request()->file('image1');
		$files = request()->file('image');
		if(empty($file1) || empty($files))
		{
			$this->error('未选择图片，请返回添加',url('admin/goods/pictureadd'));
		}
		$info1 = $file1->move(ROOT_PATH . 'public' . DS .'uploads');
		if($info1)
		{
			 $picture1 = $info1->getSaveName();
			 $picture1 =str_replace('\\','/',$picture1);
		}else{
			echo $file1->getError();
		}
		
		/*dump($files);*/
		$arr = [];
		foreach($files as $file)
		{
			$info = $file->validate(['size'=>15678000,'ext'=>'jpg,gif,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
			if($info)
			{
				//成功上传，获取上传信息
				$arr[] = str_replace('\\','/',$info->getSaveName());
			}else{
				echo $file->getError();
			}
		}
		$picture = implode(',',$arr);
		$re = $de->addthing($picture,$picture1);
		if(!empty($re))
		{
			$this->success('添加成功',url('admin/goods/products_list'));
		}else{
			$this->error('加入失败',url('admin/goods/picture'));
		}
	}
	public function addcate(Request $request)
	{
		$pid = $request->param('id');
		$cname = $request->param('name');
		$cate = new Category;
		$re = $cate->addlist($pid,$cname);
		if($re)
		{
			return json(['errcode'=>1]);
		}else{
			return json(['errcode'=>0]);
		}
	}
	public function upcate(Request $request)
	{
		$cid = $request->param('id');
		$cname = $request->param('name');
		$cate  = new Category;
		$re = $cate->uplist($cid,$cname);
		if($re)
		{
			return json(['errcode'=>1]);
		}else{
			return json(['errcode'=>0]);
		}
	}
	public function del(Request $request)
	{
		$cid = $request->param('id');
		$cate = new Category;
		$re = $cate->dellist($cid);
		if($re)
		{
			return json(['errcode'=>1]);
		}else{
			return json(['errcode'=>0]);
		}
	}
	public function addtong(Request $request)
	{
		$cid = $request->param('id');
		$cname = $request->param('name');
		$cate = new Category;
		$re = $cate->zengtong($cid,$cname);
		if($re)
		{
			return json(['errcode'=>1]);
		}else{
			return json(['errcode'=>0]);
		}
	}
	public function change()
	{
		$sid = $_GET['sid'];
		$re = Db::name('details')->where('sid',$sid)->find();
		$arr = explode(',',$re['pictures']);
		$cate = new Category;
		$re1 = $cate->selectmin();
		$this->assign('sid',$sid);
		$this->assign('re1',$re1);
		$this->assign('arr',$arr);
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function xiugai()
	{
		/*dump($info);*/
		$file1 = request()->file('image1');
		$files = request()->file('image');
		if(empty($file1) || empty($files))
		{
			$this->error('修改失败',url('admin/goods/products_list'));
		}
		$info1 = $file1->move(ROOT_PATH . 'public' . DS .'uploads');
		if($info1)
		{
			 $picture1 = $info1->getSaveName();
			 $picture1 =str_replace('\\','/',$picture1);
		}else{
			echo $file1->getError();
		}
		
		/*dump($files);*/
		$arr = [];
		foreach($files as $file)
		{
			$info = $file->validate(['size'=>15678000,'ext'=>'jpg,gif,png'])->move(ROOT_PATH . 'public' . DS . 'uploads');
			if($info)
			{
				//成功上传，获取上传信息
				$arr[] = str_replace('\\','/',$info->getSaveName());
			}else{
				echo $file->getError();
			}
		}
		$picture = implode(',',$arr);
		$de = new Details;
		$re = $de->xiuxiu($picture,$picture1);
		if(!empty($re))
		{
			$this->success('修改成功',url('admin/goods/products_list'));
		}else{
			$this->error('修改失败',url('admin/goods/picture'));
		}
	}
	public function dels(Request $request)
	{
		$sid = $request->param('sid');
		$re = Db::name('details')->where('sid',$sid)->setField('isshelf',1);
		$info = Db::name('details')->where('isshelf',0)->count();
		if($re)
		{
			return json(['errcode'=>1,'info'=>$info]);
		}else{
			return json(['errcode'=>0,'info'=>$info]);
		}
	}
}