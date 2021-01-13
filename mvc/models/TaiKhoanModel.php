<?php
class TaiKhoanModel extends DataBase{
	public function getAll(){
		$query = "SELECT * FROM users ORDER BY IdUser DESC";
		return mysqli_query($this->conn,$query);
	}

	public function getTaiKhoanVaiTro($vaitro,$trangthai){
		$query = "SELECT * FROM users WHERE VaiTro = '$vaitro' AND TrangThai = $trangthai ORDER BY IdUser DESC";
		return mysqli_query($this->conn,$query);
	}

	public function getTaiKhoanTrangThai($trangthai){
		$query = "SELECT * FROM users WHERE TrangThai = $trangthai ORDER BY IdUser DESC";
		return mysqli_query($this->conn,$query);
	}

	public function getTaiKhoanId($id){
		$query = "SELECT * FROM users WHERE IdUser = $id";
		return mysqli_query($this->conn,$query);
	}

	public function updatePassword($id,$password,$date){
		$query = "UPDATE users SET MatKhau = '$password' , updated_at = '$date' WHERE IdUser = $id";
		return mysqli_query($this->conn, $query);
	}

	// dùng để kích hoạt tài khoản
	public function getTaiKhoanEmail($email){
		$query = "SELECT * FROM users WHERE TenDangNhap = '$email'";
		return mysqli_query($this->conn,$query);
	}

	public function addTaiKhoan($hoten,$sdt,$tendangnhap,$diachi,$matkhau,$vaitro,$trangthai,$makichhoat,$gioitinh,$ngaysinh,$ngaytao,$file){
		$query = "INSERT INTO users(HoTen,SoDienThoai,DiaChi,TenDangNhap,MatKhau,VaiTro,TrangThai,MaKichHoat,GioiTinh,NgaySinh,created_at,AnhDaiDien)
		VALUES ('$hoten','$sdt','$diachi','$tendangnhap','$matkhau','$vaitro','$trangthai','$makichhoat','$gioitinh','$ngaysinh','$ngaytao','$file')";
		$result = mysqli_query($this->conn,$query);
		if($result){
			return mysqli_insert_id($this->conn);
		}else{
			return "Lỗi";
		}
		// echo "string";
	}

	public function addTaiKhoanUser($name,$email,$password,$makichhoat,$ngaytao,$file,$vaitro,$status){
		$query = "INSERT INTO users(HoTen,TenDangNhap,MatKhau,MaKichHoat,created_at,AnhDaiDien,VaiTro,TrangThai) VALUES('$name','$email','$password','$makichhoat','$ngaytao','$file','$vaitro','$status')";
		if(mysqli_query($this->conn,$query)){
			return mysqli_insert_id($this->conn);
		}else{
			return "Lỗi";
		}
	}

	public function updateTaiKhoan($hoten,$sdt,$diachi,$hash_mkmoi,$gioitinh,$ngaysinh,$file,$ngaysua,$id){
		$queryupdate = "UPDATE users SET HoTen = '$hoten' , SoDienThoai = '$sdt' , DiaChi = '$diachi', MatKhau = '$hash_mkmoi', GioiTinh = '$gioitinh' , NgaySinh = '$ngaysinh' , AnhDaiDien = '$file', updated_at = '$ngaysua'
		WHERE IdUser = $id";
		return mysqli_query($this->conn,$queryupdate);
	}

	public function update_infouser($username,$phone,$address,$birthday,$gender,$created_at,$file,$id){
		$query = "UPDATE users SET HoTen = '$username' , SoDienThoai = '$phone', DiaChi = '$address', NgaySinh = '$birthday', GioiTinh = '$gender', created_at = '$created_at', AnhDaiDien = '$file' WHERE IdUser = '$id'";
		return mysqli_query($this->conn,$query);
	}

	// sửa thông tin tài khoản khi kích hoạt ok
	public function updateTaiKhoanKichHoat($ngaykichhoat,$id){
		$query = "UPDATE users SET TrangThai = '1',ngay_kichhoat ='$ngaykichhoat', MaKichHoat = NULL WHERE IdUser = '$id'";
		return mysqli_query($this->conn,$query);
	}

	// khóa tài khoản
	public function lockTaiKhoan($songaykhoa,$ngaykhoa,$ngaymokhoa,$id){
		$query ="UPDATE users SET TrangThai = '2',ngay_khoa = '$ngaykhoa', ngay_mokhoa ='$ngaymokhoa' WHERE IdUser = $id";
		return mysqli_query($this->conn,$query);
	}

	// mở khóa tài khoản
	public function unlockTaiKhoan($id){
		$query ="UPDATE users SET TrangThai = '1' , ngay_khoa = NULL , ngay_mokhoa = NULL WHERE IdUser = $id";
		return mysqli_query($this->conn,$query);
	}

	// hoàn tác tài khoản
	public function hoantac($id){
		$query = "UPDATE users SET TrangThai = 1 WHERE IdUser = $id";
		return mysqli_query($this->conn,$query);
	}

	// xóa tài khoản nhưng vẫn còn lưu trong database
	public function deleteTaiKhoan($id,$trangthai){
		if($trangthai == "xoatam"){
			$query = "UPDATE users SET TrangThai = 3 WHERE IdUser = $id";
		}else if($trangthai == "xoa"){
			$query = "DELETE FROM users WHERE IdUser = $id";
		}
		return mysqli_query($this->conn,$query);
	}
}
?>