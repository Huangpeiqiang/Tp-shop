<?php
namespace Admin\Controller;
use Think\Controller;
class CatController extends Controller {
    public function cateadd(){
        $conn = D('cat');
        if (empty($_POST)) {
            $catlist = $conn->getTree();
            $this->assign('catlist',$catlist);
            $this->display();
        }else{
            if ($conn->add($_POST)) {
                $this->redirect('Admin/Cat/catelist');
            }else{
                echo 'error';
            }
        }    
    }
    public function catelist(){
            $conn = D('cat');
            $catlist = $conn->getTree();
            $this->assign('catlist',$catlist);
            $this->display();   
    }
    public function cateedit(){
        $conn = D('cat');
        if (empty($_POST)) {
            $catinfo = $conn->find(I('get.cat_id'));
            $gettree = $conn->select();
            $this->assign('catinfo',$catinfo);  
            $this->assign('gettree',$gettree);
            $this->display();
        }else{
            $conn->where('cat_id='.I('post.cat_id'))->save($_POST);
            print_r($_POST);
        }
    }

    public function catedel(){
        $conn = D('cat');
        if ($conn->delete(I('get.cat_id'))) {
            $this->redirect('Admin/Cat/catelist');
        }else{
            echo "删除出错";
        }
    }
}
