<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;
class Detail extends controller
{
	public function introduction()
	{
		return $this->fetch();
	}
}