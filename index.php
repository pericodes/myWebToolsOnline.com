<?php 
	require_once 'app/controllers/tools/ControllerFactory.class.php';
	echo ControllerFactory::createController('index.php')->render(); 
 ?>