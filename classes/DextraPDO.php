<?php

class DextraPDO
{
	private static $Instance = null;
	
	private function __construct() {}
	
	private static function CreatePDO()
	{
		$dsn = 'mysql:host=localhost;port=3306;dbname=dextra_pos';
		$user = 'emotion';
		$pass = 'dextrapos';
		
		return new PDO($dsn, $user, $pass);
	}
	
	public static function Close()
	{
		self::$Instance = null;
	}
	
	public static function GetInstance()
	{
		if(self::$Instance == null)
			self::$Instance = self::CreatePDO();
			
		return self::$Instance;
	}
}