<?php

class UserModulesManager
{
	public static function GetModules($userId)
	{
		if(self::IsAdmin($userId))
			return DextraDB::GetAll(DextraDB::MODULO);
			
		$sql = "select m.* from usuarios_submodulos u inner join submodulos s on u.submodulo = s.id inner join modulos m on s.modulo = m.id_modulo where u.usuario = ? group by m.id_modulo";
		$pdo = DextraPDO::GetInstance();
		$q = $pdo->prepare($sql);
		$q->execute(array($userId));
		
		return ($q->rowCount() > 0 ? $q->fetchAll() : array());
	}
	
	public static function GetSubmodulesFromModule($module, $userId)
	{
		$sql = "select s.* from submodulos s inner join usuarios_submodulos u on s.id = u.submodulo where s.modulo = ? and u.usuario = ?";
		$params = array($module, $userId);
		
		if(self::IsAdmin($userId))
		{
			$sql = "select * from submodulos where modulo = ?";
			$params = array($module);
		}
			
		$pdo = DextraPDO::GetInstance();
		$query = $pdo->prepare($sql);
		$query->execute($params);
		$results = $query->fetchAll(PDO::FETCH_ASSOC);
		DextraPDO::Close();
		
		return $results;
	}		
	
	public static function IsAdmin($userId)
	{
		$sql = "select u.id_perfil, p.nombre_perfil from usuarios u inner join perfiles p on u.id_perfil = p.id_perfil where u.id_usuario = ?";
		$pdo = DextraPDO::GetInstance();
		$q = $pdo->prepare($sql);
		$q->execute(array($userId));
		
		$u = $q->fetch();
		if($u["nombre_perfil"] == "administrador")
			return true;
			
		return false;
	}
}

?>