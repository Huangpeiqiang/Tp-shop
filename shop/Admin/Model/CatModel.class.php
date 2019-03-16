<?php
namespace Admin\Model;
use Think\Model;

class CatModel extends Model{
	public function __construct()
	{
		parent::__construct();
		$this->cats=$this->select();
	}
	public function getTree($p=0)
	{
		$tree=array();
		foreach ($this->cats as $v) {
			if ($v['parent_id']==$p) {
					$v['lv']=$v['lv']++;
					$tree[]=$v;//将二维函数转化为一维函数
					$tree = array_merge($tree,$this->getTree($v['cat_id']));
				}	
		}
		return $tree;
	}
}

?>