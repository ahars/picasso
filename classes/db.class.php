<?php 

/**
* DB
*/
class DB{

	private $pdo;
	private $default = array(
		'datasource' => 'Database/MySQL',
		'persistent' => false,
		'host' => '127.0.0.1',
		'login' => 'picasso',
		'password' => 'picasso',
		'database' => 'picasso',
		'prefix' => '',
		'encoding' => 'utf8',
	);
	private $messages = array();
	private $lastId;

	function __construct($default = null){
		if (!isset($default)) {
			$default = $this->default;
		}
		try{
		    $this->pdo = new PDO('mysql:host='.$default['host'].';dbname='.$default['database'], $default['login'], $default['password'],array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ));
			$this->messages['db'] = "DB initialized";
		}catch(PDOException $e){
	        echo '<br>Erreur : '.$e->getMessage().'<br />';
	       	echo '<br>N° : '.$e->getCode();
	       	die("<br>Erreur dans la construction de DB");
		}
	}

	public function lastId(){
		return $this->lastId;
	}

	public function lastError(){
		return $this->messages['error'];
	}

	public function lastDBMessage(){
		return $this->messages['db'];
	}

	public function lastQuery(){
		return $this->messages['last_query'];
	}

	public function find($query = "", $array = null, $assoc = true){
		if ($query != "") {
			if (!isset($array)) {
				$req = $this->pdo->query($query); 
			}else{
				$req = $this->pdo->prepare($query);
				$req->execute($array);
			}
			$datas = ($assoc) ? $req->fetchAll(PDO::FETCH_ASSOC) : $req->fetchAll(PDO::FETCH_NUM);
   			$req->closeCursor();
			$this->messages['last_query'] = $query;
			return $datas;
		}
		return false;
	}

	public function save($table = "", $array = null, $idnull = true){
		if ($table != "" && isset($array)) {
			if ($idnull) {
				$query = "INSERT INTO $table (id,";
			}else{
				$query = "INSERT INTO $table (";
			}
			foreach ($array as $k => $v) {
				$query .= " $k,";
			}
			$query = substr($query, 0, -1);
			$query .= ") VALUES ";
			if ($idnull) {
				$query .= "( null,";
			}else{
				$query .= "( ";
			}
			foreach ($array as $k => $v) {
				$query .= " :$k,";
			}
			$query = substr($query, 0, -1);
			$query .= ");";
			$this->messages['last_query'] = $query;
			$req = $this->pdo->prepare($query);
			try {
				$req->execute($array);
				$this->lastId = $this->pdo->lastInsertId();
				return true;
			} catch (PDOException $e) {
				return false;
			}
		}
		return false;
	}

	public function update($table, $array = null, $condition = null){
		if ($table != "" && $condition != "" && isset($array)) {
			$query = "UPDATE $table SET";

			foreach ($array as $k => $v) {
				$query .= " $k=:$k,";
			}
			
			$query = substr($query, 0, -1);
			$query .= " WHERE $condition ;";
			$this->messages['last_query'] = $query;
			$req = $this->pdo->prepare($query);
			$req->execute($array);
			return true;
		}
		return false;
	}

	public function delete($table, $condition){
		if ($table != "" && $condition != "") {
			$query = "DELETE FROM $table WHERE $condition";
			$this->messages['last_query'] = $query;
			$req = $this->pdo->exec($query);
			return true;
		}
		return false;
	}

}
