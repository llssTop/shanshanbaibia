<?php
namespace app\admin\Model;
use think\Model;
use think\Db;
class Details extends Model
{
	public function category()
	{
		return $this->belongsTo('Category','cname');
	}
	public function chakan()
	{
		$detail = Db::name('details')
		->select();
		return $detail;
	}
	public function addthing($photo,$pic)
	{
		$details = new Details;
		//dump($_POST['cate']);die;
		/*$details->get($_POST['cate'],'category');
		$cid = $details->cid;*/
		//dump($photo);die;
		$details->data = ([
			/*'cid' => "$cid",*/
			'name' => $_POST['name'],
			'code' =>$_POST['code'],
			'address' => $_POST['address'],
			'brand' => $_POST['brand'],
			'price' => $_POST['price'],
			'stock' => $_POST['stock'],
			'weight' => $_POST['weight'],
			'taste' => $_POST['taste'],
			'keywords' => $_POST['keywords'],
			'description' => $_POST['editorValue'],
			'picture' => $pic,
			'pictures' => $photo,
		]);
		return $details->save();
	}
}