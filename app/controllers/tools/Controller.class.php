<?php  
	require_once 'app/dependencies/vendor/autoload.php';

	abstract class Controller {
		private static $loader;
		private static  $twig;
		protected $path;
		protected $arguments;

		function __construct($path)
		{
			$this->path = $path; 
		}

		private static function getTwig(){
			if(!isset(self::$twig)){
				if(!isset(self::$loader))
					self::$loader = new \Twig\Loader\FilesystemLoader('./app/views/html/');
				self::$twig = new \Twig\Environment(self::$loader);
			}
			return self::$twig;
		}

		public function render(){ 
			$template = self::getTwig() -> load($this->path);
			
			if($this->arguments)
				return $template -> render($this->arguments);
			else
				return $template -> render();
		}
	}

?>