
<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;
class Collection extends Controller
{
	public function collection()
	{
		return $this->fetch();
	}
	public function comment()
	{
		return $this->fetch();
	}
	public function commentlist()
	{
		return $this->fetch();
	}
	public function foot()
	{
		return $this->fetch();
	}
	public function logistics()
	{
		return $this->fetch();
	}
	public function news()
	{
		return $this->fetch();
	}
}