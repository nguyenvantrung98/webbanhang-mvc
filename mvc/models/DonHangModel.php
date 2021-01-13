<?php
	class DonHangModel extends DataBase{
		public function getAll(){
			$query = "SELECT * FROM donhang ORDER BY IdDonHang DESC";
			return mysqli_query($this->conn,$query);
		}

		public function getDonHangId($id){
			$query = "SELECT * FROM donhang WHERE IdDonHang = $id";
			return mysqli_query($this->conn,$query);
		}

		public function getDonHangIdUser($id,$status){
			if($status == 0){
				$query = "SELECT * FROM donhang WHERE IdUser = $id AND TrangThai IN(0,1) ORDER BY ngaydat DESC";
			}elseif($status == 1){
				$query = "SELECT * FROM donhang WHERE IdUser = $id AND TrangThai = 2 ORDER BY ngaydat DESC LIMIT 0,4";
			}elseif($status == 2){
				$query = "SELECT * FROM donhang WHERE IdUser = $id ORDER BY ngaydat DESC";
			}
			return mysqli_query($this->conn,$query);
		}

		public function getDonHangTrangThai($id){
			$query = "SELECT * FROM donhang WHERE TrangThai = $id ORDER BY IdDonHang DESC";
			return mysqli_query($this->conn,$query);
		}

		public function getDonHangIdSanPham($id){
			$query = "SELECT * FROM donhang_sp WHERE IdSanPham = $id";
			return mysqli_query($this->conn,$query);
		}

		public function getDonHangSpId($id){
			$query = "SELECT * FROM donhang_sp WHERE IdDonHang = $id";
			return mysqli_query($this->conn,$query);
		}

		public function chotdon($id,$ngaychotdon){
			$query = "UPDATE donhang SET TrangThai = 1 , ngaychotdon = '$ngaychotdon' , ngayhuy = NULL WHERE IdDonHang = $id";
			return mysqli_query($this->conn,$query);
		}

		public function huydon($id,$ngayhuydon){
			$query = "UPDATE donhang SET TrangThai = 3 , ngaychotdon = NULL , ngayhuy = '$ngayhuydon' WHERE IdDonHang = $id";
			return mysqli_query($this->conn,$query);
		}

		public function updateDonHang($id,$trangthai){
			$query = "UPDATE donhang SET TrangThai = $trangthai WHERE IdDonHang = $id";
			return mysqli_query($this->conn,$query);
		}

		public function addDonHang($status,$idUser,$date_order,$total_money,$id_products){
			$query = "INSERT INTO donhang(TrangThai,IdUser,ngaydat,TongTien) 
					VALUES('$status','$idUser','$date_order','$total_money')";
			if(mysqli_query($this->conn,$query)){
				$id = mysqli_insert_id($this->conn);
				foreach ($id_products as $key => $value){
					$id_product = $value['id']; // id sản phẩm
					$quantity = $value['quantity']; // số lượng
					$size = $value['size']; // size
					$image = $value['image'];
					$nameproduct = $value['nameproduct'];
					// xóa bỏ dấu chấm-đ đi , parse chuỗi sang int
					$price1 = str_replace("đ","",str_replace(".","",$value['price']));
					if($value['sale'] == 0){
						$new_price = (int)$price1;
					}else{
						// tính giá giảm 
						$new_price = (int)$price1 * ((100-(int)$value['sale'])/100);
					}
					$price = number_format($new_price,0,",",".")."đ";
					
					$prices = ((int)$quantity * (int)$new_price); // thành tiền
					$total_prices = number_format($prices,0,",",".")."đ";

					// thêm dữ liệu xuống db
					$query1 = "INSERT INTO donhang_sp(IdDonHang,IdSanPham,SoLuongSanPham,SizeSanPham,DonGiaSanPham,ThanhTienSanPham,HinhAnh,TenSanPham) 
					VALUES('$id','$id_product','$quantity','$size','$price','$total_prices','$image','$nameproduct')";
					// khi mà đặt đơn thành công thì xóa số lượng sp bên sản phẩm đi theo sl sp mà ng dùng order
					if(mysqli_query($this->conn,$query1)){
						$updateSanPham = "UPDATE sanpham SET SoLuong =(SoLuong - $quantity) WHERE IdSanPham = $id_product";
						mysqli_query($this->conn,$updateSanPham);
					}
				}
				return true;
			}else{
				return false;
			}
		}

		public function deleteDonHang($id){
			$query = "DELETE from donhang WHERE IdDonHang = $id";
			mysqli_query($this->conn,$query);
		}
	}
?>