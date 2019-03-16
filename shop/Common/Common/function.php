<?php 
function ccode($user_id,$username)
	{
		$ccode= md5($user_id.$username.C('SALT_KEY'));
		return $ccode;
	}
function check()
{
	$key = cookie('uid').cookie('username').C('SALT_KEY');
	if(md5($key)===cookie('key')) {
		
		return true;
	}else{
		return false;
	}
}
 ?>