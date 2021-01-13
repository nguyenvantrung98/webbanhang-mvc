<?php 
	class GopYModel extends DataBase{
		public function getAll(){
			$query = "SELECT * FROM phanhoi ORDER BY IdPhanHoi DESC";
			return mysqli_query($this->conn,$query);
		}

		public function deletePhanHoi($id){
			$query = "DELETE FROM phanhoi WHERE IdPhanHoi = $id";
			return mysqli_query($this->conn,$query);
		}
	}
?>