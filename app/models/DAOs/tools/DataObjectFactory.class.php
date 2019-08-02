<?php 
	require_once 'app/models/DAOs/ExampleDAO.class.php';
	

	final class DataObjectFactory {

		private static $dataObjects = array();

		private function __construct($argument)
		{
			# code...
		}

		public static function getDataObject($dataObject)
		{

			if(!isset(self::$dataObjects[$dataObject])){
				self::createDataObject($dataObject);
			}
			return self::$dataObjects[$dataObject];
			
		}

		private static function createDataObject($dataObject){
			switch ($dataObject) {
				case 'example':
					self::$dataObjects[$dataObject] = new ExampleDAO(); 
					break;
				default:
					throw new Exception("No dataObject found with this name: " . $dataObject);
					break;
			}
		}


	}


 ?>