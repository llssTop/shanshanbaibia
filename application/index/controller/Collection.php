<?php
namespace app\index\controller;
use think\Controller;
use think\Validate;
use think\Request;
use app\index\model\Comment;
use app\index\model\Order;
use think\Session;
use think\Db;
class Collection extends Controller
{
	protected $comment;
	protected $order;
	public function _initialize()
	{
		$this->commentdis = new Comment;
		$this->order = new Order;
	}
	public function collection()
	{
		return $this->fetch();
	}
	public function comment()
	{
		return $this->fetch();
	}
	public function commentlist(Request $request)
	{
		$orid = $request->param('orderid');
		//dump($orid);
		$result = $this->order->checkCom($orid);
		$sid = $result['sid'];
		$result['gosid'] = $this->order->selectshop($sid);
		//dump($result['gosid']);die;
		$this->assign('result',$result);
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
	public function upload()
	{
		$oid = input('orderid');
		$sid = input('sid');
	/*	dump($oid);
		dump($sid);die;*/
		//dump($_FILES);die;
		$files = request()->file('image');
		//dump($files);die;
		$uid = session('userid');
		$a = [];
		$path ='';
		//$status ='';
		if(!empty($files)){
			foreach($files as $k => $file){
				// 移动到框架应用根目录/public/uploads/ 目录下
				$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
				if($info){
				//$imgpath = $info->getFilename();
				$imgpath = $info->getSaveName();
				$imgpath = str_replace('\\', '/',$imgpath);
				$a[$k] = $imgpath; 
			}else{
			// 上传失败获取错误信息
			echo $file->getError();
			}
			}
			foreach($a as $k)
			{
				$path .= $k . ',';
			}
		}
		$path =rtrim($path,',');
		//dump($path);die;
		if(!empty($_POST['ok1'])){
			$status = 3;
		}
		if(!empty($_POST['ok2'])){
			$status = 2;
		}
		if(!empty($_POST['ok3'])){
			$status = 1;
		}

		$content = $_POST['discontent'];
		$result = $this->commentdis->insertCom($path,$status,$content,$oid,$sid,$uid);
		if($result){
			$this->success('评论成功',url('index/collection/comment'));
		}else{
			$htis->error('评论失败',url('index/collection/comment'));
		}
	}
}