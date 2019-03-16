<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
	public function goods()
	{
		date_default_timezone_set("Asia/Shanghai");
		$gid = I('get.goods_id');
		$goods = D('goods');
		$goodsinfo = $goods->where(array('goods_id' => $gid))->order('goods_id desc')->find();
		$goodsinfo['add_time'] = date('Y年m月d日',$goodsinfo['add_time']);
		$this->assign('goodsinfo',$goodsinfo);

		$this->history($goodsinfo);

		$this->assign('mbx',$this->mbx($goodsinfo['cat_id']));
		
		$comm = $goods->relationGet('comment');
		$this->assign('comment',$comm);

		$this->display();
	}
	public function comment()
	{
		$comm = D('comment');
		if (!empty($_POST)) {
			if (!$comm->create($_POST)) {
				$this->error($comm->getError());
			}
			$comm->pubtime=time();
			$comm->goods_id=I('get.goods_id');

			if ($comm->add($co)) {
				$this->success('评论成功');
			}
		}
	}
	public function history($row)	
	{
		if (!empty($row)){
			$history = session('history') ? session('history') : array();
			$g = array();
			$g['goods_name'] = $row['goods_name'];
			$g['shop_price'] = $row['shop_price'];
			$g['thumb_img'] = $row['thumb_img'];

			if(isset($histroy[$row['goods_id']])){
				var_dump(isset($histroy[$row['goods_id']]));
				unset($histroy[$row['goods_id']]);
			}

			$history[$row['goods_id']] = $g;
		

		if (count($history)>5) {
			$key = key($history);
				unset($key);
		}
		session('history',$history);
		}
	}
	public function gwc()
	{
		$goodsinfo = D('goods')->find(I('get.goods_id'));
		$gwc = new \Home\Tool\AddTool();
		$gwc->add($goodsinfo['goods_id'],$goodsinfo['goods_name'],$goodsinfo['shop_price']);
	}
	public function mbx($cat_id)//面包屑导航
	{
		$cat = D('cat');
		$fm=array();
		$list = $cat->select();
		while ($cat_id>0) {
			foreach ($list as $v) {
				if ($v['cat_id']==$cat_id) {
					$fm[]=$v;
					$cat_id=$v['parent_id'];
					break;
				}		
			}
		}
		return array_reverse($fm);
	}
}
?>