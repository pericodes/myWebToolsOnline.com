<?php 
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	ini_set('display_errors', 'On');

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	require_once 'app/dependencies/vendor/autoload.php';

	function getTwig(){
		$loader = new \Twig\Loader\FilesystemLoader('./app/views/html/');
		$twig = new \Twig\Environment($loader);
		return $twig;
	}

	function render($path, $arguments = []){ 
		$template = getTwig()->load($path);
		echo $template -> render($arguments);
	}

	$path = strtolower ($_SERVER['REQUEST_URI']);

	if(preg_match("/[^\\\\]+$/", getcwd(), $subfolder)){

		$subfolder = strtolower($subfolder[count($subfolder)-1]);
	}
	$path = str_replace("$subfolder/", "", $path); 
	$aux = explode("/", $path);
	$element = $aux[1];
	$name = isset($aux[2]) ? $aux[2] : False;
	$query = $_SERVER['QUERY_STRING'];

	switch ($element) {
		case 'strings':
			
			switch ($name) {
				case 'characterscounter':
					render("CharactersCounter.html");
					break;
				case 'find':
					render("Find.html");
					break;
				case 'replace':
					render("Replace.html");
					break;
				case 'stringstransformations':
					render("StringsTransformations.html");
					break;
				default:
					render("index.html");
					break;
			}

			break;
		
		default:
			render("index.html");
			break;
	}

 ?>