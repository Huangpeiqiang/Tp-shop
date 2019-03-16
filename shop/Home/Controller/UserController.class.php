<?php 
namespace Home\Controller;
use Think\Controller;
 class UserController extends Controller
 {
 	public $user;
 	public function __construct()
 	{	
 		parent::__construct();
 		$this->user=D('user');
 	}
 	public function reg()
 	{
 		if(empty($_POST)){
 			$this->display('reg');
 		}else{
 			if (!$this->user->create($_POST)) {
 				echo $this->user->geterror();
 			}else{
 				if(!$this->user->reg()){
 					$this->error('reg error');
 				}else{
 					$this->success('注册成功');
 				}
 			}
 		}
 	}
 	public function login()
 	{
 		if (empty($_POST)) {
 			$this->display();
 		}else{
 			//验证码验证
 			if (!$this->checkYzm($_POST['yzm'])) {
 				$this->error('验证码错误');
 			}
 			//用户名密码验证
 			$use = $this->user->where('username=\''. $_POST['username'].'\'')->find();
 			if (!$use) {
 				$this->error('用户名或密码有误');
 			}
 			$pwd = $_POST['password'].$use['salt'];
 			if(md5($pwd)!=$use['password']){
 				$this->error('用户名或密码有误','',2);
 			}else{
 				cookie('username',$use['username']);
				cookie('uid',$use['user_id']);
				cookie('key',ccode($use['user_id'],$use['username']));
 				$this->success('login!',U('/home/index/index'),2);
 			}
 			
 		}
 	}
 	public function loginout()
 	{
 		cookie('username',null);
 		cookie('uid',null);
 		cookie('key',null);
 		$this->success('退出登录',U('home/index/index'),2);
 	}
 	public function yzm()
 	{
 		ob_clean();

 		$code = new \Think\Verify();
 		$code->entry();
 	}
 	public function checkYzm($code,$id='')
 	{
 		$verify = new \Think\Verify();
		return $verify->check($code, $id);
 	}
 } 
 ?>