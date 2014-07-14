<?php
/**
 * @author Ganesh
 *
 */
class DatabaseFunction {
	
	public $DBH = NULL;
	
	public function __construct(){
		$this->connect();
	}

	public function __destruct() {
		$this->disconnect();
	}
	
	/**
	 * Database Connection Code
	 */
	public function connect() {
		$conn_str = "mysql:host=".dbhost.";dbname=".dbdatabase;
		$user = dbusername;
		$pass = dbpassword;
		try {
			$this->DBH = new PDO($conn_str, $user, $pass);
		} catch (Exception $e) {
			echo $e;
		}
	}
	
	public function disconnect() {
		$this->DBH = NULL;
	}

	public function getTableData($tableName, $fields, $condition) {
		$arr = NULL;
		$col = (is_null($fields)) ? '*' : (is_array($fields) ? '`'.implode("`,`", $fields).'`' : '*') ;
		$whereSQL = '';
		if(!empty($condition))
		{
			// check to see if the 'where' keyword exists
			if(substr(strtoupper(trim($condition)), 0, 5) != 'WHERE')
			{
				// not found, add key word
				$whereSQL = " WHERE ".$condition;
			} else
			{
				$whereSQL = " ".trim($condition);
			}
		}
		$sql = 'SELECT '.$col.' FROM `'.$tableName.'`'.$whereSQL;
// 		try {
// 			$STH = $this->DBH->query('SELECT * FROM `'.$tableName.'`');
// 			$arr = $STH->fetchAll();
// 		} catch (Exception $e) {
// 			echo $e;
// 		}
		return $sql;
	}
	
	public function insertRow($tableName, $data) {
		// retrieve the keys of the array (column titles)
		$fields = array_keys($data);
		
		// build the query
		$sql = "INSERT INTO ".$tableName." (`".implode('`,`', $fields)."`) VALUES('".implode("','", $data)."')";
		
		// run and return the query result resource
		return $sql;
	}
	
	public function updateRow($tableName, $data, $condition) {
		// check for optional where clause
		$whereSQL = '';
		if(!empty($condition))
		{
			// check to see if the 'where' keyword exists
			if(substr(strtoupper(trim($condition)), 0, 5) != 'WHERE')
			{
				// not found, add key word
				$whereSQL = " WHERE ".$condition;
			} else
			{
				$whereSQL = " ".trim($condition);
			}
		}
		// start the actual SQL statement
		$sql = "UPDATE ".$tableName." SET ";
		
		// loop and build the column /
		$sets = array();
		foreach($data as $column => $value)
		{
			$sets[] = "`".$column."` = '".$value."'";
		}
		$sql .= implode(', ', $sets);
		
		// append the where statement
		$sql .= $whereSQL;
		
		// run and return the query result
		return($sql);
	}
	
	public function deleteRow($tableName, $condition) {
		// check for optional where clause
		$whereSQL = '';
		if(!empty($condition))
		{
			// check to see if the 'where' keyword exists
			if(substr(strtoupper(trim($condition)), 0, 5) != 'WHERE')
			{
				// not found, add keyword
				$whereSQL = " WHERE ".$condition;
			} else
			{
				$whereSQL = " ".trim($condition);
			}
		}
		// build the query
		$sql = "DELETE FROM ".$tableName.$whereSQL;
		
		// run and return the query result resource
		return($sql);
	}
	
	public function truncateTable($tableName) {

	}
	
	public function deleteTable($tableName) {
		
	}
}
?>