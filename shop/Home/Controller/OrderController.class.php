<?php 
namespace Home\Controller;
use Think\Controller; 
class OrderController extends Controller
{	
	public function checkout()
	{
		$this->assign('gwc',session('gwc'));
		$gwc = new \Home\Tool\AddTool();
		$this->assign('zj',$gwc->calcMoney());
		$this->display();
	}
}
?>