<?php
class Conexao
{
	protected $servername='localhost';
    protected $dbname='veus';
    protected $username='root';
    protected $password='';
    protected $port='5432';
    protected $conn = 'null';
    
	public function __construct(){

	}
	
	//king host
	function conecta()
	{ 
		// Create connection
		$this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

		// Check connection
		if (!$this->conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		//echo "Connected successfully";
	 return $this->conn;
	}
}