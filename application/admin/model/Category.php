<?php
namespace app\admin\Model;
use think\Model;
class Category extends Model
{
	public function details() 
	{
		return $this->hasMany('Details','cate');
	}
}