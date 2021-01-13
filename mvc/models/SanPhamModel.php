<?php 
class SanPhamModel extends DataBase{
	public function getAll(){
		$query = "SELECT * FROM sanpham ORDER BY IdSanPham DESC";
		return mysqli_query($this->conn,$query);
	}

	public function getSanPhamHome($category){
		if($category == "sanpham"){
			$query = "SELECT * FROM sanpham WHERE GiamGia = 0 ORDER BY IdSanPham DESC LIMIT 12";
		}else if($category == "hotsale"){
			$query = "SELECT * FROM sanpham WHERE GiamGia > 0 ORDER BY IdSanPham DESC LIMIT 12";
		}elseif($category == "categorys"){
			$query = "SELECT * FROM sanpham ORDER BY IdSanPham DESC LIMIT 12";
		}
		return mysqli_query($this->conn,$query);
	}

	public function getSanPhamGiamGia(){
		$query = "SELECT * FROM sanpham WHERE GiamGia != 0 ORDER BY IdSanPham DESC";
		return mysqli_query($this->conn,$query);
	}

	public function getSanPhamId($id){
		$query = "SELECT * FROM sanpham WHERE IdSanPham = $id";
		$kq = mysqli_query($this->conn,$query);
		return $kq;
	}

	public function getSanPhamIdTheLoai($id){
		$query = "SELECT * FROM sanpham WHERE IdTheLoai = $id";
		return mysqli_query($this->conn,$query);
	}

	public function getSanPhamLienQuanId($idcate,$idproduct){
		$query = "SELECT * FROM sanpham WHERE IdTheLoai = $idcate AND IdSanPham != $idproduct ORDER BY IdSanPham DESC LIMIT 4";
		return mysqli_query($this->conn,$query);
	}

	public function addSanPham($tensanpham,$tenkhongdau,$mota,$gia,$soluong,$giamgia,$tentheloai,$chonkieusize,$ngaytao){
		$querychitiet = "INSERT INTO sanpham(TenSanPham,TenKhongDau,MoTa,Gia,SoLuong,GiamGia,IdTheLoai,IdKieuSize,created_at)
		VALUES('$tensanpham','$tenkhongdau','$mota','$gia','$soluong','$giamgia','$tentheloai','$chonkieusize','$ngaytao')";
		if(mysqli_query($this->conn,$querychitiet)){
			// nếu thêm thành công thì trả về id sp vừa thêm xong
			return mysqli_insert_id($this->conn);
		}else{
			$loi = "Lỗi";
			return $loi;
		}
	}

	public function updateSanPham($tensanpham,$tenkhongdau,$mota,$gia,$soluong,$giamgia,$tentheloai,$chonkieusize,$ngaysua,$id){
		$querychitiet = "UPDATE sanpham SET TenSanPham = '$tensanpham' , TenKhongDau = '$tenkhongdau' , MoTa = '$mota',
		Gia = '$gia' , SoLuong = '$soluong' , GiamGia = '$giamgia' , IdTheLoai = '$tentheloai' ,
		IdKieuSize = '$chonkieusize' , updated_at = '$ngaysua' WHERE IdSanPham = $id";
		return mysqli_query($this->conn,$querychitiet);
	}

	public function deleteSanPham($id){
		$query = "DELETE FROM sanpham WHERE IdSanPham = $id";
		return mysqli_query($this->conn,$query);
	}

	// SanPham_DonHang
	public function getSanPhamIdDonHang($id){
		$query = "SELECT * FROM donhang_sp WHERE IdDonHang = $id";
		return mysqli_query($this->conn,$query);
	}

}
?>