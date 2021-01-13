<?php
	class AdminDonHangController extends Controller{
		public function donhang($tbao){
			$donhang = $this->models("DonHangModel");
			if($tbao == "dachot"){
				$tbao = "";
				$kq = $donhang->getDonHangTrangThai(1);
			}else if($tbao == "dahuy"){
				$tbao = "";
				$kq = $donhang->getDonHangTrangThai(3);
			}else if($tbao == "dagiao"){
				$tbao = "";
				$kq = $donhang->getDonHangTrangThai(2);
			}else if($tbao == "chuachot"){
				$tbao = "";
				$kq = $donhang->getDonHangTrangThai(0);
			}else if($tbao == "Đã chốt đơn"){
				$tbao = "Chốt đơn thành công";
				$kq = $donhang->getAll();
			}else if($tbao == "Đã xóa đơn"){
				$tbao = "Xóa đơn thành công";
				$kq = $donhang->getAll();
			}else if($tbao == "Đã hủy đơn"){
				$tbao = "Hủy đơn thành công";
				$kq = $donhang->getAll();
			}else{
				$tbao = "";
				$kq = $donhang->getAll();
			}

			$this->viewsAdmin("view-main",["page"=>"admin-dsdonhang","title"=>"Danh sách đơn hàng","listdonhang"=>$kq,"tbao"=>$tbao]);
		}


		public function xemdonhang($id){
			$tbao = "";
			// lấy thông tin đơn hàng
			$donhang = $this->models("DonHangModel");
			$kq = $donhang->getDonHangId($id);
			$rs = mysqli_fetch_assoc($kq);

			// lấy thông tin ng dùng theo id
			$taikhoan = $this->models("TaiKhoanModel");
			$kq1 = $taikhoan->getTaiKhoanId($rs['IdUser']);
			$rs1 = mysqli_fetch_assoc($kq1);

			// lấy tất cả sản phẩm theo id đơn hàng
			$donhang_sp = $donhang->getDonHangSpId($id); // =>list

			// xử lý khi mà ng dùng họ kích vào chốt đơn
			if(isset($_POST['chotdon'])){
				$ten = $rs1['HoTen'];
				// đổi trạng thái thành 1 và set ngày chốt rồi gửi mail thông báo
				$ngaychotdon = $this->ngayhientai();
				echo $id;
				$kq = $donhang->chotdon($id,$ngaychotdon);
				if($kq){
					$to = $rs1['TenDangNhap'];
					$subject = "Đặt hàng thành công";
					$message = "<h1>Xin chào $ten</h1>
					<p>Cảm ơn bạn đã đặt hàng tại Shop Bán Hàng</p>
					<p>Đơn hàng của bạn đang được giao đến trong vòng 3 đến 5 ngày , hãy để ý điện thoại khi shipper của chúng tôi gọi cho bạn nhé.</p>
					<p>Thank you $ten</p>";
					$header  = "From:shopbanhang@gmail.com \r\n";
					$header .= "MIME-Version: 1.0\r\n";  
					$header .= "Content-type: text/html\r\n";
					$send = mail($to,$subject,$message,$header);
					if($send){
						$tbao = "Đã chốt đơn";
						header("location: ../donhang/".$tbao);
					}else{
						echo "Có lỗi xảy ra , vui lòng thử lại sau";
					}
				}else{
					echo "Lỗi";
				}
			}

			// xử lý khi mà ng dùng họ kích vào chốt đơn
			if(isset($_POST['huydon'])){
				$ten = $rs1['HoTen'];
				// đổi trạng thái thành 1 và set ngày chốt rồi gửi mail thông báo
				$ngayhuy = $this->ngayhientai();
				$kq = $donhang->huydon($id,$ngayhuy);
				if($kq){
					$to = $rs1['TenDangNhap'];
					$subject = "Hủy đơn hàng";
					$message = "<h1> Xin chào $ten</h1>
								<p> Chúng tôi thành thật xin lỗi bạn vì đã hủy đơn hàng của bạn.</p>
								<p> Hiện tại sản phẩm này đã hết , chúng tôi sẽ liên hệ cho bạn sớm khi có hàng trở lại.</p>
								<p>Chúng tôi thật lòng xin lỗi vì sự bất cẩn này.</p>";
					$header  = "From:shopbanhang@gmail.com \r\n";
					$header .= "MIME-Version: 1.0\r\n";  
					$header .= "Content-type: text/html\r\n";
					$send = mail($to,$subject,$message,$header);
					if($send){
						$tbao = "Đã hủy đơn";
						header("location: ../donhang/".$tbao);
					}else{
						echo "Có lỗi xảy ra , vui lòng thử lại sau";
					}
				}else{
					echo "Lỗi";
				}
			}

			$this->viewsAdmin("view-main",["page"=>"admin-xemdonhang","title"=>"Chi tiết đơn hàng","donhang"=>$rs,"taikhoan"=>$rs1,"listdonhang_sp" =>$donhang_sp,"tbao"=>$tbao]);
		}

		public function xoadonhang($id){
			$donhang = $this->models("DonHangModel");
			$donhang->deleteDonHang($id);
			$tbao = "Đã xóa đơn";
			header("location: ../donhang/".$tbao);
		}
	}
?>