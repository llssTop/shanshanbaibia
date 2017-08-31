<?php
namespace app\admin\Model;
use think\Model;
use think\Db;
use think\Paginator;
class Details extends Model
{
	public function category()
	{
		return $this->belongsTo('Category','cname');
	}

	public function addthing($photo,$pic)
	{
		$details = new Details;
		$taste = implode(',', $_POST['taste']);
		$details->data = ([
			/*'cid' => "$cid",*/
			'name' => $_POST['name'],
			'code' =>$_POST['code'],
			'address' => $_POST['address'],
			'brand' => $_POST['brand'],
			'price' => $_POST['price'],
			'stock' => $_POST['stock'],
			'weight' => $_POST['weight'],
			'taste' => $taste,
			'keywords' => $_POST['keywords'],
			'description' => $_POST['editorValue'],
			'picture' => $pic,
			'pictures' => $photo,
		]);
		return $details->save();
	}
	public function detailInfo($id)
	{
		return Db::name('details')->where('sid',$id)->find();
	}
	public function xiuxiu($photo,$pic)
	{
		$details = new Details;
		$taste = implode(',', $_POST['taste']);
		return $details->save([
			/*'cid' => "$cid",*/
			'name' => $_POST['name'],
			'code' =>$_POST['code'],
			'address' => $_POST['address'],
			'brand' => $_POST['brand'],
			'price' => $_POST['price'],
			'stock' => $_POST['stock'],
			'weight' => $_POST['weight'],
			'taste' => $taste,
			'keywords' => $_POST['keywords'],
			'description' => $_POST['editorValue'],
			'picture' => $pic,
			'pictures' => $photo,
		],['sid'=>$_POST['hidden']]);
	}
}