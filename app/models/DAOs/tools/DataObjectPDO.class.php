<?php
	require_once 'app/models/tools/DataBaseFactory.class.php';

abstract class DataObjectPDO {

	protected $tableName; 
	private $dataBase; 

	function __construct($dataBaseName)
	{
		$this->dataBase = DataBaseFactory::getDataBase($dataBaseName);
	}

	public function getItemBy($id)
	{	
		$sql = "SELECT * FROM $this->tableName WHERE id = :id"; 

		try {
			$st = getConnection()->prepare( $sql );
			$st->bindValue( ":id", $id, PDO::PARAM_INT );
			$st->execute();
			return $st->fetch(); 
		}catch ( PDOException $e ) {
			die( "PDO query fail: " . $e->getMessage() );
			
		} 

	}

	/*
	public function query_fetch_all(string $sql, int $resulttype = MYSQLI_ASSOC) {

	}
	*/

	public function getItems($order = FALSE, $rows = FALSE, $starterRow = FALSE)
	{	
		$sql = "SELECT * FROM $this->tableName";
		//try {
			if($order){
				$sql = "$sql ORDER BY :order";
				if($starterRow)
					$sql = "$sql LIMIT :starterRow, :rows";
				elseif ($rows) {
					$sql = "$sql LIMIT :rows";
				}
			}

			$st = $this->dataBase->getConnection()->prepare( $sql );
			//$st->bindValue( ":tableName", $this->tableName, PDO::PARAM_STR );
			if($order){
				$st->bindValue( ":order", $rows, PDO::PARAM_STR );
				if($starterRow){
					$st->bindValue( ":starterRow", $starterRow, PDO::PARAM_INT );
					$st->bindValue( ":rows", $rows, PDO::PARAM_INT );
				}elseif ($rows) {
					$st->bindValue( ":rows", $rows, PDO::PARAM_INT );
				}
			}
			$st->execute();
			return $st->fetchAll();
		//} catch ( PDOException $e ) {
		//	throw new Exception ( "PDO query fail: " . $e->getMessage() );
		//}
		

	}
}
?>