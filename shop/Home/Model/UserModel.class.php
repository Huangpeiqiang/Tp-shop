<?php 
namespace Home\Model;
use Think\Model;
class UserModel extends Model
{
	public $_validate = array(
		array('username','/\w{6,16}/','用户名6-16,由下划线数字字母组成',1,'regex',1),
		array('email','email','必须按email写法',1,'',1),
		array('password','6,16','密码必须在6-16字符间',1,'length',1),
		array('repwd','password','两次密码不相同',1,'confirm',1)
		);
	//注册加密部分
	public function reg(){
		$this->encPass();
		return $this->add();
	}
	protected function encPass()
	{
		$this->salt();
		$this->password = md5($this->password.$this->salt);
	}
	protected function salt(){
		if (!$this->salt) {
			$this->salt = $this->randStr();
		}
		return $this->salt;
	}
	protected function randStr($num=5)
	{
		$str =str_shuffle('ABCDEFGHIJKMLNOPQRSTUVWXYZabcdefghijkmlnopqrstuvwxyz0123456789');
		return substr($str,0,$num);
	}
	
} 
?>