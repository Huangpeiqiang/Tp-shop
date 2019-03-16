<?php 
namespace Home\Controller;
use Think\Controller;
class CatController extends Controller{
	public $goods;
	public function __construct(){
		parent::__construct();
		$this->goods = D('goods');
	}
	public function cat()
	{
		$goodslist = $this->goods->select();
		$this->assign('goodslist',$goodslist);

		$count = $this->goods->count();
		$this->assign('his',session('history'));
		$this->assign('count',$count);
		$this->display();
	}
}
 ?>