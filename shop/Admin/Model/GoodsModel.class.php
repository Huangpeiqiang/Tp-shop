<?php
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{
	//array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间])
    public $_validate = array(
    	array('goods_name','2,10','商品名必须在2-10字符',1,'length',3),
    	array('is_best',array(0,1),'精品名只允许是0或1',1,'in',3),
        array('goods_sn','','货号重复了',1,'unique',3),
    	array('cat_id','ckc','请先分类',1,'callback',3)
    	);
    protected $_auto = array(
        array('add_time','time',1,'function'),
        array('last_update','time',2,'function'),
    );
    protected function ckc(){
    	$cat = D('cat');
    	return $cat->find($_POST['cat_id'])?true:false;
    }

}
