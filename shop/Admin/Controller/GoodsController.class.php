<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {
    public $gm;
    public function __construct()
    {
        parent::__construct();
        $this->gm = D('goods');
    }
    public function goodsadd(){
    	$gm = D('goods');
    	if (empty($_POST)) {
            $cat = D('cat');
            $catlist = $cat->getTree();
            $this->assign('catlist',$catlist);
    		$this->display();
    	}else{
            //文件上传
            $upload = new \Think\Upload();
            $upload->maxSize = 1024*1024*5;
            $upload->exts = array('jpg','jpeg','png','gif');
            $upload->rootPath = './Upload/';
            $upload->savePath = '';
            if ($info=$upload->upload()) {
                $path = $info['goods_img']['savepath'].$info['goods_img']['savename'];
                $_POST['goods_img'] = '/Upload/'.$path;
                //缩略图
                $image = new \Think\Image();
                $image->open($_POST['goods_img']);
                if ($image->thumb(150, 150)->save('/Upload/thumb/'.$info['goods_img']['savename'])) {
                    $_POST['thumb_img']= '/Upload/thumb/'.$info['goods_img']['savename'];
                }else{
                    $this->error($this->getError());
                }
            }else{
                $this->error($upload->getError());
            }
    		if (!$gm->create($_POST)) {
    			echo $gm->geterror();
    		}else{
    			$gm->add();
                $this->success('商品添加成功');
    		}
    	}    	
    }
    public function goodslist(){
        $list = $this->gm->order('goods_id')->page($_GET['p'].',3')->select();
        $this->assign('list',$list);// 赋值数据集

        $count = $this->gm->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,5);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $Page->show();// 分页显示输出
        print_r($show);
        $this->assign('page',$show);// 赋值分页输出
        $this->display(); // 输出模板  
    }

    public function del(){
        
    }



}
