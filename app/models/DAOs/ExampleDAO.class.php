<?php 
	require_once 'app/models/DAOs/tools/DataObjectPDO.class.php';

	/**
	 * 
	 */
	class ExampleDAO extends DataObjectPDO
	{
		
		function __construct()
		{
			$this->tableName="example";
			parent::__construct('mainPDO');
		}


	}


?>