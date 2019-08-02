 <?php

class DataBaseMySQL
{
	
	private $connection;
	private $host;
	private	$user;
	private	$password;
	private	$name;

	public function __construct($credentialsPath)
	{	

		$credentials 	= parse_ini_file($credentialsPath);
		$this->host 	= $credentials["host"];
		$this->user 	= $credentials["user"];
		$this->password = $credentials["password"];
		$this->name 	= $credentials["name"];
		
	}

	public function getConnection() {
		if(!$this->connection){
			/*$this->connection = new mysqli($this->host, $this->user, $this->password, $this->name);
			if(! $this->connection)
				die("DataBase connection fail: ");
			$this->connection->set_charset("utf8");*/
			
			$this->connection = new mysqli($this->host, $this->user, $this->password, $this->name);
			//var_dump($this->connection);
			if($this->connection->connect_errno){
				throw new Exception("DataBaseMySQL connection fail: (". $this->connection->connect_errno . ".)". $this->connection->connect_error);
			}		
			$this->connection->set_charset("utf8");
			
		}
		
		return $this->connection; 

	}

	public function query(string $sql) {
		
		$connection = self::getConnection();
		$sql = $connection -> real_escape_string($sql); 
		$query = $connection -> query($sql);

		if($query === FALSE){
			throw new Exception("Error executing query: $sql." . PHP_EOL);
		}

		return $query;
	}

	public function query_fetch_object(string $sql) {
		$result = array();
		//$sql = mysqli_real_escape_string($sql);
		$query = self::query($sql); 
		if(mysqli_num_rows($query) > 0) {
			while($obj = $query -> fetch_object()) {
				array_push($result, $obj);
			}
		}
		
		//mysql_free_result($query);
		
		return $result;
	}

	public function query_fetch_all(string $sql, int $resulttype = MYSQLI_ASSOC) {
		$result = array();
		$query = self::query($sql); 
		if(mysqli_num_rows($query) > 0) {
			$result = mysqli_fetch_all($query, $resulttype); 
		}
		$query ->free();
		//mysql_free_result($query);
		
		return $result;
	}

	public function insert($sql) {
		return self::getconnection() -> query($sql);
	}

}
	
?>
