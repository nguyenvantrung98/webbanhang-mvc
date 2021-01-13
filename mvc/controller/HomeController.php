<?php 
class HomeController extends Controller{
	public function home(){
		$notication = "";
		$product = $this->models("SanPhamModel");
		$category = $this->models("TheLoaiModel");
		$slide = $this->models("SlideModel");
		$categories = $this->models("DanhMucModel");

		$listproduct = $product->getSanPhamHome("sanpham");
		$listproductsale = $product->getSanPhamHome("hotsale");
		$listcategory = $category->getAll();
		$listslide = $slide->getAll();
		$listcategorie = $categories->getAll();
		$listcategories = array_reverse(mysqli_fetch_all($listcategorie,MYSQLI_ASSOC));
		// var_dump($listcategories);

		$this->viewsUsers("trangchu",['listproduct'=>$listproduct,'listcategory'=>$listcategory,'listproductsale'=>$listproductsale,'listslide'=>$listslide,'listcategories'=>$listcategories,'notication'=>$notication]);
	}

	public function infouser($update){
		// check xem đã login chưa
		$this->checkLogin();
		if($update == "Cập nhật thành công" || $update == "Số điện thoại đã tồn tại" || $update == "Vui lòng nhập đầy đủ thông tin" || $update == "Số điện thoại của bạn không đúng"){
			$noti = $update;
		}elseif($update == "update_product"){
			if(empty($_SESSION['infouser']['phone']) || empty($_SESSION['infouser']['address'])){
				$noti = "Cập nhật thông tin đầy đủ để đặt hàng";
			}else{
				// tạo ra 1 mã random để check khi ng dùng vào đặt hàng mà ko thông qua trang giỏ hàng
				$check = str_shuffle(str_repeat("qwertyuiopasdfghjklzxcvbnm", 4)); 
				// đưa mã lên session
				$_SESSION['check'] = $check;
				header("location: http://localhost/webbanhang-mvc/GioHangController/order/".$check);
			}
		}elseif($update == "update_user" || $update == "update_product_cart"){
			$noti = "";
		}else{
			// nếu ng dùng nhập url mà ko tồn tại
			header("location: ../HomeController/home");
		}

		// xử lý khi ng dùng nhấn cập nhật thông tin
		if(isset($_POST['update_info'])){
			$image = $_FILES['image_user'];
			// nếu ng dùng có chọn ảnh mới
			if($image['error'] == 0){
				$file = "./public/upload/taikhoan/".$this->random().$image['name'];
				if (file_exists($file)) {
					$file = "./public/upload/taikhoan/".str_shuffle($this->random()).$image['name'];
				}
			}else{ // ko chọn
				$file = $_SESSION['infouser']['image'];
			}
			// lấy dữ liệu từ server gửi về
			$phone = trim($_POST['phone']);
			$address = trim($_POST['address']);
			$username = trim($_POST['username']);
			$checkname = str_replace("-"," ",$this->xoadau($username));
			if(trim($_POST['gender']) == ""){
				$gender = null;
			}else{
				$gender = trim($_POST['gender']);
			}
			if(trim($_POST['birthday']) == ""){
				$birthday = null;
			}else{
				$birthday = trim($_POST['birthday']);
			}
			$updated_at = $this->ngayhientai();

			// validate dữ liệu
			if($phone == "" || $address == "" || $username == ""){
				$noti = "Vui lòng nhập đẩy đủ thông tin";
				// header("location: http://localhost/webbanhang-mvc/HomeController/infouser/".$noti);
			}else{
				$regex_phone = "/^\+?(?:0|84)[0-9]{9}$/";
				$regex_username = "/^[a-zA-Z ]*$/"; // chứa chữ và khoảng trắng
				$regex_address = "/^[a-zA-Z\/,0-9- ]+[^@!#$%^&*()_+=]+$/"; // ko đc chứa kí tự đặc biệt
				if(preg_match($regex_phone,$phone) && preg_match($regex_username,$checkname) && preg_match($regex_address,$address)){
					// validate name , địa chỉ
					$user = $this->models("TaiKhoanModel");
					$result = $user->update_infouser($username,$phone,$address,$birthday,$gender,$updated_at,$file,$_SESSION['infouser']['id']);
					if($result){
						if($_SESSION['infouser']['image'] != $file){
							// ktra để ko pải xóa ảnh mặc định đi
							if($_SESSION['infouser']['image'] != "./public/upload/taikhoan/anhdaidien.png"){
								unlink($_SESSION['infouser']['image']); // xóa ảnh cũ
							}
							move_uploaded_file($image['tmp_name'],$file);
						}
						// cập nhật thông tin lên session
						$_SESSION['infouser']['username'] = $username;
						$_SESSION['infouser']['phone'] = $phone;
						$_SESSION['infouser']['address'] = $address;
						$_SESSION['infouser']['gender'] = $gender;
						$_SESSION['infouser']['birthday'] = $birthday;
						$_SESSION['infouser']['image'] = $file;
						// ktra xêm đang ở hành động nào
						if($update == "update_product" || $update == "update_product_cart"){
							$check = str_shuffle(str_repeat("qwertyuiopasdfghjklzxcvbnm", 4));
							$_SESSION['check'] = $check;
							header("location: http://localhost/webbanhang-mvc/GioHangController/order/".$check);
						}elseif($update == "update_user"){
							$noti = "Cập nhật thành công";
							header("location: ../infouser/".$noti);
						}
					}else{
						$noti = "Số điện thoại đã tồn tại";
						header("location: ../infouser/".$noti);
					}
				}else{
					if(!preg_match($regex_phone,$phone)){
						$noti = "Số điện thoại của bạn không đúng";
					}elseif(!preg_match($regex_username,$checkname)){
						// var_dump($username);
						$noti = "Họ tên không được chứa kí tự đặc biệt và chữ số";
					}elseif(!preg_match($regex_address,$address)){
						$noti = "Địa chỉ không được chứa kí tự đặc biệt (@!#$%^&*()_+-=)";
					}
				}
			}
		}
		$this->viewsUsers("thongtincanhan",['noti'=>$noti]);
	}

	public function makichhoat($makichhoat,$id){
		$kichhoat = $this->models("TaiKhoanModel");
		$kq = $kichhoat->getTaiKhoanId($id);
		$rs = mysqli_fetch_assoc($kq);
			if(strcmp($rs['MaKichHoat'], $makichhoat) == 0){ // nếu 2 makichhoat giống nhau
				// đổi trang thái dưới database và xóa makichhoat đi
				$ngaykichhoat = $this->ngayhientai();
				$kq1 = $kichhoat->updateTaiKhoanKichHoat($ngaykichhoat,$id);
				if($kq1){
					$tbao = "Tài khoản đã được kích hoạt , hãy đăng nhập để trải nghiệm mua sắm";
				}
			}else{ // ko giống
				$tbao = "Đã xảy ra lỗi , link đã được kích hoạt";
			}
			$this->viewsUsers("kichhoattaikhoan",["tbao"=>$tbao]);
		}
	}
?>