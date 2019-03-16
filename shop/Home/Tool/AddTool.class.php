<?php 
namespace Home\Tool;

class AddTool {
	public $item;
	public function __construct(){
		 $this->item = session('?gwc')?session('gwc'):array();
	}
	/**
	* 商品添加
	* @param $goods_id 
	* @param $goods_name 
	* @param $shop_price 
	* @return boolean
	*/
	public function add($goods_id,$goods_name,$shop_price){
		if (isset($this->item[$goods_id])) {
			$this->item[$goods_id]['num']++;
		}else{
			$goods['goods_name'] = $goods_name;
			$goods['shop_price'] = $shop_price;
			$goods['num'] = 1;
			$this->item[$goods_id]=$goods;
		}
	}
	/**
	* @param $goods_id int 􀠟􀟝id
	* 减少商品
	*/
	public function decr($goods_id){
		if (--$this->item[$goods_id]['num']<=0) {
			unset($this->item[$goods_id]);
		}	
	}
	/**
	*删除商品
	* @param $goods_id 􀠟􀟝id
	*/
	public function del($goods_id){
		unset($this->item[$goods_id]);
	}
	/**
	* 列出商品名单
	* @return Array
	*/
	public function items(){
		return $this->item;
	}
	/**
	* 返回有几类商品
	* @return int
	*/
	public function calcType(){
		return count($this->item);
	}
	/**
	* 返回有几件商品
	* @return int
	*/
	public function calcCnt(){
		foreach ($this->item as $v) {
			$sum += $v['num'];
		}
		return $sum;
	}
	/**
	* 返回总价格
	* @return float
	*/
	public function calcMoney(){
		$sum = 0;
		foreach ($this->item as $v) {
			$t = $v['num']*$v['shop_price'];
			echo $t.'<br>';
			$sum += $t;
			echo $sum.'<br>';
		}
		return $sum;
	}
	/**
	* 清空购物车
	* @return void
	*/
	public function clear(){
		$this->item = null;
	}

	public function __destruct()
	{
		session('gwc',$this->item);
	}
}

 ?>