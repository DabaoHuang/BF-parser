<?
	
	class SQL_DB {
	
 var $dbInsert;
 
	    function sql_db( $gb_DBHOSTname,$gb_DBname,$gb_DBuser,$gb_DBpass ) {

 		 $this->dbInsert = new PDO('mysql:host='.$gb_DBHOSTname.';port=3306;dbname='.$gb_DBname, $gb_DBuser , $gb_DBpass );
 		 $sth = $this->dbInsert->prepare("SET NAMES UTF8");
  		 $sth->execute();
	  	}
	  	
		function num_rows($sthOBJ) {
 
			return $sthOBJ->rowCount();
		}
	  
		function query($query, $arr) {
			
			if (!is_array($arr)) throw new Exception('need array');
			
		    $sth = $this->dbInsert->prepare($query );
   		 	$sth->execute($arr);
			$this->sth = $sth;
			
			$errorInfo = $this->sth->errorInfo();
 			if ((int)$errorInfo[1]!=0) throw new Exception((int)$errorInfo[1]."_".$errorInfo[2]);
			
			
			
 			return $sth; 
		}
		function fetch_record_obj($sthOBJ) {
			return $sthOBJ->fetch(PDO::FETCH_OBJ);
		}
		function fetch_record($sthOBJ) {
 			return $sthOBJ->fetch(PDO::FETCH_ASSOC);
		}

		function fetch_record_set($sthOBJ) {
			
			while ($setArrayRec = $this->fetch_record($sthOBJ)) {
				
			$setArray[] = 	$setArrayRec;
			}
 			return  $setArray;
		}		
		
		function error() {
			$errorInfo = $this->sth->errorInfo();
 			
			return array('code' => (int)$errorInfo[1], 'message' => $errorInfo[2] );
			
		}
		function insert_id() {
 			return $this->dbInsert->lastInsertId();
		}
 
}
 
$db = new SQL_DB( "localhost","database","db_user","db_pass");
?>
