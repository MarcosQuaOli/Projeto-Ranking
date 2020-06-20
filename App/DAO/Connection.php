<?php 

namespace App\DAO;

class Connection extends \PDO {

	private $conn;

	public function __construct(){

		$dbhost = getenv('CODEEASY_GERENCIADOR_DE_LOJAS_MYSQL_HOST');
        $dbuser = getenv('CODEEASY_GERENCIADOR_DE_LOJAS_MYSQL_USER');
        $dbpass = getenv('CODEEASY_GERENCIADOR_DE_LOJAS_MYSQL_PASSWORD');
        $dbname = getenv('CODEEASY_GERENCIADOR_DE_LOJAS_MYSQL_DBNAME');

		$this->conn = new \PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $dbuser, $dbpass);

	}

	private function setParams($statement, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$this->setParam($statement, $key, $value);

		}

	}

	private function setParam($statement, $key, $value){

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(\PDO::FETCH_OBJ);

	}

}

 ?>