<?php
/**
* 
*/
class PassHash {

	public static function hash($password){
		$hash_password = crypt($password);
		return $hash_password;
	}


	public static function checkPassword($password, $hash_password){
		if (crypt($password, $hash_password == $hash_password)) {

			return "MOT DE PASSE CORRECT";
		}else{
			return "MOT DE PASSE INCORRECT";
		}
	}

}
