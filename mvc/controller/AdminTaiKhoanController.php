<?php
class AdminTaiKhoanController extends Controller{

	public function taikhoan($key,$action){
		$tbao = "";
		$taikhoan = $this->models("TaiKhoanModel");
		if($action == "list"){
			if($key == "danhsach"){
				$kq = $taikhoan->getTaiKhoanTrangThai(1);
			}else if($key == "nguoidung"){
				$vaitro = "Người dùng";
				$kq = $taikhoan->getTaiKhoanVaiTro($vaitro,1);
			}else if($key == "quantri"){
				$vaitro = "Quản trị";
				$kq = $taikhoan->getTaiKhoanVaiTro($vaitro,1);
			}else if($key == "chuakichhoat"){
				$kq = $taikhoan->getTaiKhoanTrangThai(0);
			}else if($key == "dangkhoa"){
				$kq = $taikhoan->getTaiKhoanTrangThai(2);
			}else if($key == "daxoa"){
				$kq = $taikhoan->getTaiKhoanTrangThai(3);
			}
		}
		// chuyển về trang danh sách khóa
		else if($action == "Khóa thành công"){
			$tbao = $action;
			$kq = $taikhoan->getTaiKhoanTrangThai(2);
		}
		// chuyển về trang danh sách đang hoạt độg
		else if($action == "Mở khóa thành công" || $action == "Hoàn tác thành công" || $action == "Xóa thành công"){
			$tbao = $action;
			$kq = $taikhoan->getTaiKhoanTrangThai(1);
		}
		// khi ng dùng nhập bậy bạ
		else{
			$kq = $taikhoan->getTaiKhoanTrangThai(1);
		}
		
		$this->viewsAdmin("view-main",["page"=>"admin-dstaikhoan","title"=>"Danh sách tài khoản","listtaikhoan"=>$kq,"tbao"=>$tbao]);
	}


	public function xemtaikhoan($id){
		$tbao = "";
		$taikhoan = $this->models("TaiKhoanModel");
		$kq = $taikhoan->getTaiKhoanId($id);

		// xử lý khi ng dùng kích khóa tài khoản
		if(isset($_POST['locktaikhoan'])){
				// lấy số ngày ng dùng chọn
			$songaykhoa = $_POST['chonsongaykhoa'] .' day';
			// sử dụng hàm strtotime để cộng trừ ngày
			// lấy ngày hiện tại
			$ngaykhoa = $this->ngayhientai();
			$ngaymokhoa = strtotime ($songaykhoa, strtotime ( $ngaykhoa ) ) ; // hàm strtotime trả kết quả về 1 dãy số theo kiểu timestamp
			$ngaymokhoa = date ('Y-m-d H:i:s' , $ngaymokhoa ); // ép kiểu từ dãy nhị phân đó sang kiểu date

			// đưa dữ liệu qua model xử lý
			$kq = $taikhoan->lockTaiKhoan($songaykhoa,$ngaykhoa,$ngaymokhoa,$id);
			if($kq){
				$tbao = "Khóa thành công";
				header("location: ../taikhoan/danhsach/".$tbao);
			}else{
				$tbao = "Khóa thất bại";
				header("location: ../taikhoan/danhsach/".$tbao);
			}
		}

		// xử lý khi ng dùng kích mở khóa tài khoản
		if(isset($_POST['unlocktaikhoan'])){
			// sửa trạng thái thành hoạt động và xóa ngày mở khóa cx như ngày khóa đi
			$kq = $taikhoan->unlockTaiKhoan($id);
			if($kq){
				$tbao = "Mở khóa thành công";
				header("location: ../taikhoan/danhsach/".$tbao);
			}else{
				$tbao = "Mở khóa thất bại";
				header("location: ../taikhoan/danhsach/".$tbao);
			}
		}

		// xử lý khi ng dùng kích vào nút hoàn tác tài khoản
		if(isset($_POST['hoantac'])){
			// đổi trạng thái thành 1 
			$kq = $taikhoan->hoantac($id);
			if($kq){
				$tbao = "Hoàn tác thành công";
				header("location: ../taikhoan/danhsach/".$tbao);
			}
		}

		$this->viewsAdmin("view-main",["page"=>"admin-thongtintaikhoan","title"=>"Thông tin tài khoản","chitiettaikhoan"=>$kq,"tbao"=>$tbao]);
	}


	public function xoataikhoan($id,$trangthai){
		$xoataikhoan = $this->models("TaiKhoanModel");
		$kq = $xoataikhoan->deleteTaiKhoan($id,$trangthai);
		if($kq){
			$tbao = "Xóa thành công";
			header("location: http://localhost/webbanhang-mvc/AdminTaiKhoanController/taikhoan/danhsach/".$tbao);
		}
	}


	public function themtaikhoan($tbao){
		$thongbao = "";
		if($tbao != "add"){
			$thongbao = $tbao;
		}

		// xử lý khi ng dùng kích thêm
		if(isset($_POST['addtaikhoan'])){
			//lấy tất cả thông tin từ ng dùng nhập
			$anhdaidien = $_FILES['file'];
			$file = './public/upload/taikhoan/'.$this->random().$anhdaidien['name'];
			$hoten = $_POST['hoTen'];
			$tendangnhap = $_POST['tenDangNhap'];
			// mã hóa mật khẩu sang dạng bcrypt
			$matkhau = password_hash( $_POST['matKhau'], PASSWORD_DEFAULT);
			$sdt = $_POST['sdt'];
			if($_POST['vaiTro'] == 1){
				$vaitro = 'Quản trị';
			}else if($_POST['vaiTro'] == 2){
				$vaitro = 'Người dùng';
			}
			$diachi = $_POST['diaChi'];
			$gioitinh = NULL;
			$ngaysinh = NULL;
			// gioi tinh và ngày sinh ko bắt buộc nên ktra xem ng dùng có nhập ko
			if(isset($_POST['gender'])){
				$gioitinh = $_POST['gender'];
			}
			if(isset($_POST['ngaysinh'])){
				$ngaysinh = $_POST['ngaysinh'];
			}
			// tạo random 1 chuỗi kích hoạt
			$makichhoat = str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5));
			$ngaytao = $this->ngayhientai();
			$trangthai = 0;

			$addtaikhoan = $this->models("TaiKhoanModel");
			$kq = $addtaikhoan->addTaiKhoan($hoten,$sdt,$tendangnhap,$diachi,$matkhau,$vaitro,$trangthai,$makichhoat,$gioitinh,$ngaysinh,$ngaytao,$file);
			// if ko có lỗi gì thì đưa ảnh vào fordel upload và thông báo lỗi và gửi mail kèm theo makichhoat đến email đó để kích hoạt tài khoản
			if($kq != "Lỗi"){
				// // lấy id của tài khoản vừa thêm thành công
				// $id = mysqli_insert_id($conn);
				move_uploaded_file($anhdaidien['tmp_name'],$file);
				// xử lý hàm gửi email
				$to = $tendangnhap;
				$subject = "Kích hoạt tài khoản";
				$message = "<h1> Xin chào $hoten </h1>
				<p> Cảm ơn bạn đã đăng ký tài khoản tại Shop Bán Hàng </p>
				<p> Để sử dụng tài khoản vui lòng kích vào đường dẫn bên dưới để kích hoạt</p>
				<p>Mã kích hoạt : </p>
				<a href='http://localhost/webbanhang-mvc/HomeController/makichhoat/$makichhoat/$kq'>$makichhoat</a>";
				$header  = "From:shopbanhang@gmail.com \r\n";
				$header .= "MIME-Version: 1.0\r\n";  
				$header .= "Content-type: text/html\r\n";
				$send = mail($to,$subject,$message,$header);
				// if gửi thành công
				if($send){
					$tbao = "Tài khoản đã được tạo , vui lòng check email để kích hoạt tài khoản";
					header("location: ./".$tbao);
				}
				else{
					$tbao = "Vui lòng kiểm tra bảo mật của email để nhận được mã kích hoạt";
					header("location: ./".$tbao);
				}
			}
			else{// if có lỗi thì thông báo lỗi đó
				$tbao = "Email hoặc số điện thoại đã tồn tại , vui lòng kiểm tra lại";
				header("location: ./".$tbao);
			}
		}
		$this->viewsAdmin("view-main",["page"=>"admin-themtaikhoan","title"=>"Thêm tài khoản","tbao"=>$thongbao]);
	}


	public function thongtincanhan($id,$tbao){
		if($tbao == "info"){
			$thongbao = "";
		}
		else{
			$thongbao = $tbao;
		}
		$a = $this->models("TaiKhoanModel");
		$kq = $a->getTaiKhoanId($_SESSION['infouser']['id']);

			// xử lý khi ng dùng kích cập nhật
		if(isset($_POST['updatesanpham'])){
			$update = $this->models("TaiKhoanModel");
			$rs = mysqli_fetch_assoc($kq);
			$hinh1 = $_FILES['file-main'];
				// ktra ng dùng có thay đổi hình ko
				if($hinh1['error'] > 0){ // ko chọn
					$file = $rs['AnhDaiDien'];
				}else{
					$file = './public/upload/taikhoan/'.$this->random().$hinh1['name']; // đường dẫn
				}
				// lấy các thông tin khác
				$hoten = $_POST['hoTen'];
				$sdt = $_POST['sdt'];
				$diachi = $_POST['diaChi'];
				$gioitinh = "";
				// ktra xem ng dùng có chọn giơi tính ko
				if(isset($_POST['gender'])){
					$gioitinh = $_POST['gender'];
				}
				$ngaysinh = $_POST['ngaysinh'];
				$ngaysua =$this->ngayhientai();

				// ktra xem ng dung có chọn đổi mk ko
				if(isset($_POST['dmk'])){
					$mkhientai = $_POST['mkhientai'];
					$mkmoi = $_POST['mkmoi'];
					$nlmkmoi = $_POST['nlmkmoi'];

					// xử lý password , kiểm tra mk hiện tại có khớp ko
					// có thì xử lý mk mới ,ko thì bắt nhập lại
					$checkmkhientai = password_verify($mkhientai,$rs['MatKhau']);
					// var_dump($checkmkhientai);
					if($checkmkhientai){ //nếu mk đúng
						// xử lý mk mới
						$hash_mkmoi = password_hash($mkmoi, PASSWORD_DEFAULT);
						$kq= $update->updateTaiKhoan($hoten,$sdt,$diachi,$hash_mkmoi,$gioitinh,$ngaysinh,$file,$ngaysua,$id);
						if($kq){
							// nếu thêm thành công thì xóa ảnh cũ
							unlink($rs['AnhDaiDien']);
							move_uploaded_file($hinh1['tmp_name'],$file);
							$tbao = "Cập nhật thành công";
							// thông báo và trả về view
							header("location: ../".$id."/".$tbao);
						}
					}else{
						$tbao = "Mật khẩu hiện tại không đúng";
						header("location: ../".$id."/".$tbao);
					}
				}else{
					$mkhientai = $rs['MatKhau'];
					// ko chọn đổi mật khẩu
					$kq= $update->updateTaiKhoan($hoten,$sdt,$diachi,$mkhientai,$gioitinh,$ngaysinh,$file,$ngaysua,$id);
					if($kq){
							// nếu thêm thành công thì xóa ảnh cũ
						unlink($rs['AnhDaiDien']);
						move_uploaded_file($hinh1['tmp_name'],$file);
						$tbao = "Cập nhật thành công";
						// thông báo và trả về view
						header("location: ../".$id."/".$tbao);
					}
				}
			}

			$this->viewsAdmin("admin-thongtincanhan",["thongtincanhan"=>$kq,"tbao"=>$thongbao]);
		}
	}

?>