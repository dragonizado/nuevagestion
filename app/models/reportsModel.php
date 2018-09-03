<?php 
/**
 * Dragonizado 2018
 */
class reportsModel extends Model
{
	
	function __construct($db)
	{
		try {
			$this->_db = $db;
		} catch (PDOException $e) {
			exit("No se puede conectar a la base de datos.");
		}
	}

	
}
 ?>