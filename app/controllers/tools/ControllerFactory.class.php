<?php 
	require_once 'app/controllers/Index.class.php';
	
/**
 * 
 */
abstract class ControllerFactory
{
	
	public static function createController($path)
	{
		switch ($path) {
			case 'index.php':
				return new Index(); 
				break;
			default:
				return new NotFound();
				break;
		}
	}
}


?>