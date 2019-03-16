<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$cat = D('Admin/cat');
    	$cattree = $cat->getTree();
    	$this->assign('cattree',$cattree);

    	$this->assign('his',session('history'));

        $this->display();
    }
	
}