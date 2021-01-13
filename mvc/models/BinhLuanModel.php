<?php 
	class BinhLuanModel extends DataBase{
		public function getAll(){
			$query = "SELECT * FROM binhluan ORDER BY IdBinhLuan DESC";
			return mysqli_query($this->conn,$query);
		}

		public function getCommentId($id){
			$query = "SELECT * from binhluan WHERE IdSanPham = $id ORDER BY IdBinhLuan DESC";
			return mysqli_query($this->conn,$query);
		}

		public function deleteBinhLuan($id){
			$query = "DELETE FROM binhluan WHERE IdBinhLuan = $id";
			return mysqli_query($this->conn,$query);
		}

		// có sử dụng transaction
		public function addComment($content,$iduser,$idproduct,$date){
			// khai báo tạm ở đây , sau chuyển qua database.php cấu hình
			mysqli_autocommit($this->conn,FALSE);
			$query = "INSERT INTO binhluan(NoiDung,IdUser,IdSanPham,created_at) VALUES('$content','$iduser','$idproduct','$date')";
			$result = mysqli_query($this->conn,$query);
			if($result){
				mysqli_commit($this->conn);
				return true;
			}else{
				mysqli_rollback($this->conn);
				return false;
			}
		}

		// lấy danh sách replycomment theo id bình luận
		public function getReplyCommentId($id){
			$query = "SELECT * from repbinhluan WHERE IdBinhLuan = $id ORDER BY IdRepBinhLuan DESC";
			$rs = mysqli_query($this->conn,$query);
			return $rs;
		}

		public function addRepComment($content,$iduser,$idcomment,$date){
			// khai báo tạm ở đây , sau chuyển qua database.php cấu hình
			mysqli_autocommit($this->conn,FALSE);
			$query = "INSERT INTO repbinhluan(NoiDung,IdUser,IdBinhLuan,created_at) VALUES('$content','$iduser','$idcomment','$date')";
			$result = mysqli_query($this->conn,$query);
			if($result){
				mysqli_commit($this->conn);
				return true;
			}else{
				mysqli_rollback($this->conn);
				return false;
			}
		}

		public function test(){
			$str = "WELLCOME Trung.net TrungTrungTrung.php";
			$str1 = "WELLCOME 'Trung'.net";
			$str2 = "AdminHomeController/danhsach/list/add";
			$str3 = "hoang yen yen yen yen";
			$str4 = "Van Trung";
			$str5 = "van trung";
			var_dump(chunk_split($str1,3,"--"));
			var_dump(str_split($str1));
			echo strtolower($str) . "<br>";
			echo strtoupper($str) . "<br>";
			echo addcslashes($str, "L") . "<br>";
			echo addslashes($str1);
			var_dump(empty($str));
			echo str_replace("Trung", "Yến", $str);
			echo mysqli_character_set_name($this->conn) . "<br>";
			$kq = explode("/",$str2);
			echo $kq[1];
			var_dump($kq);
			echo strrev($str)."<br>";
			// echo ucwords($str3);
			echo ucfirst($str3)."<br>";
			echo str_shuffle(substr($str, 9,5))."<br>";
			echo substr($str, 9,5)."<br>";
			echo substr_replace($str, "1trungjj", 9,5)."<br>";
			echo substr_count($str3, "yen");
			echo substr_compare($str3, "yen", 6,3)."<br>";
			// echo strspn("subject", mask)
			echo strnatcasecmp($str4, $str5);
			echo str_word_count($str3);
			echo strlen($str);
			var_dump(explode(" ", $str3));
			echo strrev($str3) ."<br>";
			var_dump(str_split($str));
			echo strchr($str3,"yen");

			var_dump(date_default_timezone_get());
			$date = date_create("2020-12-10 18:00:30");
			date_modify($date,"+15 second");
			var_dump($date);
			echo date_format($date,"d-m-Y H:i:s");
			var_dump(getdate());
			$t = time();
			// var_dump(date_format($t,"Y-m-d H:i:s"));
			echo date("Y-m-d H:i:s",$t);
			// $query = "SELECT NoiDung , IdUser , IdSanPham FROM binhluan where IdBinhLuan = 3 ORDER BY IdBinhLuan DESC;";
			// // $query .= "SELECT * FROM danhmuc";
			// // $kq = mysqli_multi_query($this->conn,$query); //=>list
			// $kq = mysqli_query($this->conn,$query);
			// // var_dump(mysqli_fetch_all($kq,MYSQLI_ASSOC));
			// // var_dump(mysqli_fetch_field_direct($kq,1));
			// var_dump(mysqli_fetch_fields($kq));
			// var_dump(mysqli_field_count($this->conn));
			// var_dump(mysqli_get_charset($this->conn));
			// var_dump(mysqli_info($this->conn));
			// print_r(mysqli_store_result($this->conn));
			// while ($rs = mysqli_fetch_object($kq)) {
			// 	# code...
			// 	print_r($rs);
			// }
			// print_r(mysqli_fetch_object($kq1));
			// $row = mysqli_num_fields($kq);
			// echo $row;
			// var_dump(mysqli_get_charset($this->conn));
			// $kq1 = mysqli_fetch_field($kq);
			// $rs = mysqli_fetch_all($kq,MYSQLI_NUM);
			// while($rs = mysqli_fetch_field($kq)){
			// 	// echo "<br>";
			// 	print_r($rs);
			// }
			// echo "<br>";
			// mysqli_field_seek($kq,0);
			// // mysqli_field_tell($kq);
			// $rs1 = mysqli_fetch_field($kq);
			// // $kq = mysqli_affected_rows($this->conn);
			// // // $rs1 = mysqli_fetch_lengths($kq);
			// print_r($rs1);
			// print_r(mysqli_field_count($this->conn));
			// print_r(mysqli_num_rows($kq));
			// print_r(mysqli_field_seek($kq,0));
			// print_r(mysqli_fetch_row($kq));
			
			// while ($rss = mysqli_fetch_field($kq)) {
			// 	# code...
			// 	// echo $rss['name'];
			// 	echo "<prev>";
			// 	print_r($rss);
			// 	echo "</prev>";
			// }
		}

		public function testDate(){
			// $connn = $this->conn;
			mysqli_autocommit($this->conn,FALSE);
			// echo mysqli_thread_id($this->conn);
			// exit();

			$sql = "SELECT * FROM danhmuc;";
			$sql .= "SELECT * FROM theloai";
			$kq = mysqli_multi_query($this->conn,$sql);
			print_r($kq);
			var_dump(mysqli_store_result($this->conn,$kq));
			var_dump(mysqli_next_result($this->conn));
			
			// var_dump(mysqli_more_result($kq));
			exit();
			$query = "INSERT INTO danhmuc (TenDanhMuc,TenKhongDau)
				VALUES ('Quần Áo Áo23334','Quan-Ao-Ao23334')";
			if(mysqli_query($this->conn,$query)){
				mysqli_commit($this->conn);
				echo "ok";exit();
			}else{
				mysqli_rollback($this->conn);
				echo "no ok";exit();
			}
		}
	}
?>