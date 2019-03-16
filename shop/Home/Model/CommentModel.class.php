<?php 
namespace Home\Model;
use Think\Model;
class CommentModel extends Model
{
	public $_validate =array(
		array('email','email','Emai输入格式不对',1,'',1),
		array('content','require','评论不可为空',1,'',3));
}
?>