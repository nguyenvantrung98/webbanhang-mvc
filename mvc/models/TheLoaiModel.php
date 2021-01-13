<?php
class TheLoaiModel extends DataBase{
	public function getAll(){
		$query = "SELECT * FROM theloai ORDER BY IdTheLoai DESC";
		return mysqli_query($this->conn,$query);
	}

	public function getTheLoaiId($id){
		$query = "SELECT * FROM theloai WHERE IdTheLoai = $id";
		$result = mysqli_query($this->conn,$query);
		return $rs = mysqli_fetch_assoc($result);
	}

	public function addTheLoai($tentheloai,$tenkhongdau,$file,$tendanhmuc,$ngaytao){
		$query = "INSERT INTO theloai(TenTheLoai,TenKhongDau,AnhDaiDien,IdDanhMuc,created_at)
					VALUES('$tentheloai','$tenkhongdau','$file','$tendanhmuc','$ngaytao')";
		return mysqli_query($this->conn,$query);
	}

	public function updateTheLoai($tentheloai,$tenkhongdau,$chondanhmuc,$ngaysua,$file,$id){
		$query = "UPDATE theloai SET TenTheLoai = '$tentheloai' , TenKhongDau = '$tenkhongdau' ,
					AnhDaiDien = '$file' , IdDanhMuc = '$chondanhmuc' , updated_at = '$ngaysua' WHERE IdTheLoai = '$id'";
		return mysqli_query($this->conn,$query);
	}

	public function deleteTheLoai($id){
		$query = "DELETE FROM theloai WHERE IdTheLoai = $id";
		return mysqli_query($this->conn,$query);
	}

	public function getTheLoaiIdDanhMuc($id){
		$query = "SELECT * FROM theloai WHERE IdDanhMuc = $id";
		return mysqli_query($this->conn,$query);
	}
}
?>