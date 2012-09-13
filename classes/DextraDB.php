<?php

class DextraDB
{
	//nombre de las tablas
	const ALMACEN = "catalogo_almacenes";
	const MODULO = "modulos";
	const SUBMODULO = "submodulos";
	const USUARIO = "usuarios";

	//Please use the respective constant to call this method! ex: $almacen = DextraDB::GetByKey(DextraDB::ALMACEN, 4);
	public static function GetByKey($table, $key)
	{
		$sql = "select * from " . $table . " where " . self::GetTableKey($table) . " = ?";
		$pdo = DextraPDO::GetInstance();
		
		$query = $pdo->prepare($sql);
		$query->execute(array($key));
		
		$data = $query->fetch();
		DextraPDO::Close();
		
		return $data;
	}
	
	public static function GetAll($table)
	{
		$sql = "select * from " . $table;
		$pdo = DextraPDO::GetInstance();
		
		$query = $pdo->prepare($sql);
		$query->execute();
		
		$data = $query->fetchAll(PDO::FETCH_ASSOC);
		DextraPDO::Close();
		
		return $data;
	}
	
	//retorna el campo llave de una tabla (llenar manualmente)
	private static function GetTableKey($table)
	{
		switch($table)
		{
			case self::ALMACEN:
				return "id_almacen";
				
			case self::USUARIO:
				return "id_usuario";
				
			case self::MODULO:
				return "id_modulo";
		}
	}
	
	//retorna la fecha del server mysql
	public static function GetServerDate()
	{
		$pdo = DextraPDO::GetInstance();
		$query = $pdo->prepare("select year(current_date) as year, month(current_date) as month, day(current_date) as day");
		$query->execute();
		$dbdate = $query->fetch(PDO::FETCH_OBJ);
		DextraPDO::Close();
		return new Date($dbdate->year, $dbdate->month, $dbdate->day);
	}
	
	public static function GetServerTime()
	{
		$pdo = DextraPDO::GetInstance();
		$query = $pdo->prepare("select current_time");
		$query->execute();
		$dbtime = $query->fetch(PDO::FETCH_OBJ);
		DextraPDO::Close();
		
		return $dbtime->current_time;
	}
}