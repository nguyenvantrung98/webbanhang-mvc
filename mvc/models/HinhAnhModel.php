<?php
class HinhAnhModel extends DataBase{
	public function getAll(){
		$query = "SELECT * FROM hinhanh";
		return mysqli_query($this->conn,$query);
	}

	public function getHinhAnhId($id){
		$query = "SELECT * FROM hinhanh WHERE IdSanPham = $id";
		return mysqli_query($this->conn,$query);
	}

	public function getListHinhAnhId($id){
		$query = "SELECT * FROM hinhanh WHERE IdSanPham = $id LIMIT 1,4";
		return mysqli_query($this->conn,$query);
	}

	public function getHinhAnhIdSanPham($id){
		$query = "SELECT * FROM hinhanh WHERE IdSanPham = $id LIMIT 1";
		return mysqli_query($this->conn,$query);
	}

	public function updateHinhAnh($id,$file){
		$queryhinh1 = "UPDATE hinhanh SET src = '$file' WHERE IdHinhAnh = $id;";
		return mysqli_query($this->conn,$queryhinh1);
	}

	// thêm hình ảnh theo id sản phẩm
	public function addHinhAnhId($src,$idsp){
		$query1 = "INSERT INTO hinhanh(src,IdSanPham) VALUES('$src','$idsp')";
		return mysqli_query($this->conn,$query1);
	}

	public function deleteHinhAnhIdSanPham($id){
		$query = "DELETE from hinhanh WHERE IdSanPham = $id";
		return mysqli_query($this->conn,$query);
	}
}
?>