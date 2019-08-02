<?php 
	
	require_once 'app/controllers/tools/Controller.class.php';
	require_once 'app/models/tools/DataBaseFactory.class.php';
	require_once 'app/models/DAOs/tools/DataObjectFactory.class.php';

	/**
	 * 
	 */
	class Index extends Controller
	{	
		
		function __construct(){
			parent::__construct('index.html');
		}

		public function render(){
			//$a = DataBaseFactory::getDataBase("main")->insert("INSERT INTO `example`(`test`) VALUES ('fddfgsdfgsf')");
			$a = DataBaseFactory::getDataBase("main")->query_fetch_all("SELECT * FROM example");
			$a = DataBaseFactory::getDataBase("mainPDO")->getConnection();
			$a = DataObjectFactory::getDataObject("example")->getItems("id");
			//var_dump($a);
			//var_dump($a);
			return parent::render();
		}

	}

 ?>