<?php
namespace app\admin\Controller;
use app\admin\controller\Auth;
use app\admin\model\Details;
class Goods extends Auth
{
	protected $is_login = ['*'];
	public function brand_manage()
	{
		return $this->fetch();
	}
	public function category_manage()
	{
		return $this->fetch();
	}
	public function products_list(Details $de)
	{
		$re = $de->chakan();
		$this->assign('re',$re);
		return $this->fetch();
	}
	public function categoryadd()
	{
		return $this->fetch();
	}
	public function pictureadd()
	{

		return $this->fetch();
	}
	public function addbrand()
	{
		return $this->fetch();
	}
	public function upload(Details $de)
	{
		/*dump($info);*/
		$file1 = request()->file('image1');
		$info1 = $file1->move(ROOT_PATH . 'public' . DS .'uploads');
		if($info1)
		{
			 $picture1 = $info1->getSaveName();
			 $picture1 =str_replace('\\','/',$picture1);
		}else{
			echo $file1->getError();
		}
		$files = request()->file('image');
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
}