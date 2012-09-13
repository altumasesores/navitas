<?php

class User
{
	private $DbId;
	public $Username;
	public $Perfil;
	
	public static function GetInstance($key)
	{
		$row = DextraDB::GetByKey($key);
	}
}

?>