<?php 
class TaiKhoanController extends Controller{
	public function change_pass(){
		$this->checkLogin();
		$noti = "";

		if(isset($_POST['change_pass'])){
			$password = $this->test_input($_POST['password']);
			$new_password = $this->test_input($_POST['new_password']);
			$again_password = $this->test_input($_POST['again_password']);
			$number = "/^(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9!@#$%^&*()]{8,32}$/"; //ktra mk có số chưa
			$uppercase = "/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*()]{8,32}$/";//ktra chữ cái in hoa
			// ktra kí tự đặc biệt đã có chưa
			$string = "/^(?=.*[a-z])[a-zA-Z0-9!@#$%^&*()]{8,32}$/";
			$kitudacbiet = "/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()])[a-zA-Z0-9!@#$%^&*()]{8,32}$/";
			if($password == "" || $new_password == "" || $again_password == ""){
				$noti = "Vui lòng nhập đầy đủ thông tin";
			}
			// validate dữ liệu
			elseif(strlen($new_password) < 8 || !preg_match($number,$new_password) || !preg_match($uppercase,$new_password) || !preg_match($string,$new_password) || !preg_match($kitudacbiet,$new_password)){
				$noti = "Mật khẩu mới phải lớn hơn 8 kí tự , có tối thiểu 1 chữ in hoa , 1 kí tự đặc biệt và 1 chữ số";
			}else{
				// lấy password trên session xuống so sánh
				if(password_verify($password,$_SESSION['infouser']['password'])){
					// ktra mk ms vs mk cũ có giống nhau ko
					if($password == $new_password){
						$noti = "Mật khẩu mới phải khác mật khẩu cũ";
					}elseif($new_password != $again_password){// ss new_pass vs again_pass
						$noti = "Nhập lại mật khẩu không khớp với mật khẩu mới";
					}else{
						// hash pass rồi lưu vào db
						$user = $this->models("TaiKhoanModel");
						$id = $_SESSION['infouser']['id'];
						$date = $this->ngayhientai();
						$pass = password_hash($new_password, PASSWORD_DEFAULT);
						$change_ps = $user->updatePassword($id,$pass,$date);
						if($change_ps){
							$noti = "Đã đổi mật khẩu";
							// update lại trên session
							$_SESSION['infouser']['password'] = $pass;
						}else{
							$noti = "Xảy ra lỗi , vui lòng thử lại sau";
						}
					}
				}else{
					$noti = "Mật khẩu hiện tại không đúng";
				}
			}
		}
		$this->viewsUsers("doimatkhau",['noti'=>$noti]);
	}

	public function login(){
		// ktra ng dùng đã login chưa
		if(isset($_SESSION['infouser']) && !empty($_SESSION['infouser']['username'])){
			header("location: ../HomeController/home");
			exit();
		}

		$noti = "";

		// xử lý khi ng dùng kích đăng nhập
		if(isset($_POST['login'])){
			$username = $this->test_input($_POST['username']);
			$password = $this->test_input($_POST['password']);
			// echo $username;exit();

			if(empty($username) || empty($password)){
				$noti = "Tên đăng nhập hoặc mật khẩu không được để trống";
			}else{
				$taikhoan = $this->models("TaiKhoanModel");
				$kq = $taikhoan->getTaiKhoanEmail($username);
				// $password_hash = password_hash($password, PASSWORD_DEFAULT);
				if(($row = mysqli_num_rows($kq)) == 1){
					$rs = mysqli_fetch_assoc($kq);
					if($rs['TrangThai'] == 1){
						if(password_verify($password, $rs['MatKhau'])){
						// lưu thông tin tài khoản vào session và chuyển về trang chủ
							$_SESSION['infouser'] = array(
								"id" => $rs['IdUser'],
								"email" => $rs['TenDangNhap'],
								"username" => $rs['HoTen'],
								"password" => $rs['MatKhau'],
								"role" => $rs['VaiTro'],
								"phone" => $rs['SoDienThoai'],
								"address" => $rs['DiaChi'],
								"gender" => $rs['GioiTinh'],
								"birthday" => $rs['NgaySinh'],
								"image" => $rs['AnhDaiDien'],
								"status" => $rs['TrangThai']
							);
						// ktra ng dùng có chọn remember ko
							if(isset($_POST['remember'])){
								setcookie("remember" , $username , time() + (3600 * 24) , "/");
							}
							setcookie("lifetime" , "15" , time() + 900 , "/");
						// ktra ng dùng thuộc vai trò nào
							if($rs['VaiTro'] == "Quản trị" || $rs['VaiTro'] == "Admin"){
								header("location: ../AdminHomeController/home");
								exit();
							}else{
								header("location: ../HomeController/home");
								exit();
							}
						}else{
							$noti = "Mật khẩu không đúng";
						}
					}elseif($rs['TrangThai'] == 0){
						$noti = "Tài khoản chưa được kích hoạt";
					}elseif($rs['TrangThai'] == 2){
						// lấy ngày mở khóa trừ cho ngày hiện tại
						$date_lock = new Datetime($rs['ngay_mokhoa']);
						$date_now = new Datetime($this->ngayhientai());
						$date_diff = date_diff($date_lock,$date_now);
						// echo $date_diff->format("%d %h %i %s");exit();
						$noti ="Tài khoản sẽ mở lại sau : ".$date_diff->format("%dngày:%hgiờ:%iphút:%sgiây");
					}elseif($rs['TrangThai'] == 3){
						$noti = "Tài khoản đã bị xóa";
					}
				}else{
					$noti = "Tên đăng nhập or mật khẩu không đúng";
				}
			}
		}
		$this->viewsUsers("dangnhap",["noti"=>$noti]);
	}

	public function forgot_pass(){
		if(isset($_SESSION['infouser'])){
			header("location: ../HomeController/home");
		}
		$noti = "";

		// khi ng dùng qay lại trang này thì xóa dữ liệu về forgot đi (nếu có)
		if(isset($_SESSION['forgot_pass'])){
			unset($_SESSION['forgot_pass']);
		}

		if(isset($_POST['next_forgot_pass'])){
			$email = trim($_POST['email']);
			if($email == ""){
				$noti = "Email không được để trống";
			}else{
				$validate_email = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{3})+$/";
				if(preg_match($validate_email,$email)){ // nếu validate email hợp lệ
					$user = $this->models("TaiKhoanModel");
					$info = $user->getTaiKhoanEmail($email);
					if(mysqli_num_rows($info) == 1){
						$rs = mysqli_fetch_assoc($info);
						// tạo mã random 6 số gửi về mail
						$random_int = substr(str_shuffle(str_repeat("1234567890",5)),0,6); 
						$check = str_shuffle(str_repeat('1234567890qwertyuiopasdfghjklzxcvbnm', 5));
						// đẩy thông tin lên session lưu tạm
						$_SESSION['forgot_pass'] = array(
							"id" => $rs['IdUser'],
							"verification" => $random_int,
							"confirm" => $check
						);
						mail($email,"Đổi mật khẩu","Mã kích hoạt của bạn là : ".$random_int);
						header("location: ./next_forgot_pass_confirm/".$check);
						exit();
					}else{
						$noti = "Email này chưa được đăng ký";
					}
				}else{
					$noti = "Email của bạn không đúng , vui lòng kiểm tra lại";
				}
			}
		}

		$this->viewsUsers("quenmatkhau",['noti'=>$noti]);
	}

	public function next_forgot_pass_confirm($check){
		// ktra khi ng dùng chưa vô trang nhập email mà qua trang này thì ko cho
		if(isset($_SESSION['forgot_pass']['confirm'])){
			// ktra tr/hop ng dùng nhập lại đường dẫn trên url mà ko chính xác
			if($check == $_SESSION['forgot_pass']['confirm']){
				$noti = "";
				// xử lý khi ng dùng submit
				if(isset($_POST['next_forgot_pass_confirm'])){
					$verification = $_POST['verification'];
					if($verification == ""){
						$noti = "Mã xác nhận không được để trống";
					}else{
						if($verification == $_SESSION['forgot_pass']['verification']){
							$check = str_shuffle(str_repeat('1234567890qwertyuiopasdfghjklzxcvbnm', 5));
							unset($_SESSION['forgot_pass']['confirm']);
							$_SESSION['forgot_pass']['confirm_change'] = $check;
							header("location: ../next_forgot_pass_change/".$check);
							exit();
						}else{
							$noti = "Mã xác nhận không chính xác";
						}
					}
				}
				$this->viewsUsers("quenmatkhau1",['noti'=>$noti]);
			}else{
				header("location: ../forgot_pass");
			}
		}else{
			header("location: ../forgot_pass");
		}
	}

	public function next_forgot_pass_change($check){
		if(isset($_SESSION['forgot_pass']['confirm_change'])){
			if($check == $_SESSION['forgot_pass']['confirm_change']){
				$noti = "";
				if(isset($_POST['next_forgot_pass_change'])){
					$change_password = trim($_POST['change_password']);
					$change_password1 = trim($_POST['change_password1']);
					if($change_password1 == "" || $change_password == ""){
						$noti = "Vui lòng nhập đầy đủ thông tin";
					}else{
						// khớp nhau
						if($change_password == $change_password1){
							// validate dữ liệu
							$validate_password = "/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()])[a-zA-Z0-9!@#$%^&*()]{8,32}$/";
							if(preg_match($validate_password,$change_password)){ // khớp validate
								// mã hóa mật khẩu và cập nhật vào db
								$new_password = password_hash($change_password, PASSWORD_DEFAULT);
								$user = $this->models("TaiKhoanModel");
								$user->updatePassword($_SESSION['forgot_pass']['id'],$new_password,$this->ngayhientai());
								// xóa hết session lưu trữ thông tin về forgot_password
								unset($_SESSION['forgot_pass']);
								$noti = "Mật khẩu đã được đặt lại";
							}else{
								$noti = "Mật khẩu phải có 1 kí tự in hoa , 1 số , 1 kí tự đặc biệt";
							}
						}else{
							$noti = "Mật khẩu không khớp , vui lòng kiểm tra lại";
						}
					}
				}
				$this->viewsUsers("quenmatkhau2",['noti'=>$noti]);
			}else{
				header("location: ../forgot_pass");
			}
		}else{
			header("location: ../forgot_pass");
		}
	}

	public function register(){
		if(isset($_SESSION['infouser'])){
			header("location: ../HomeController/home");
		}
		$noti = "";

		if(isset($_POST['register_submit'])){
			$name = $this->test_input($_POST['username']);
			$email = $this->test_input($_POST['email']);
			$password = $this->test_input($_POST['password']);
			$confirm_password = $this->test_input($_POST['password_again']);
			$created_at = $this->ngayhientai();
			$file = "./public/upload/taikhoan/anhdaidien.png";
			$vaitro = "Người dùng";
			$status = 0;

			// validate dữ liệu
			$validate_name = "/^[a-zA-Z\s]+[^@!#$%^&*()_+-=0-9]+$/";
			$validate_email = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{3})+$/";
			$validate_password = "/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()])[a-zA-Z0-9!@#$%^&*()]{8,32}$/";

			if($name == "" || $email == "" || $password == "" || $confirm_password == ""){
				$noti = "Vui lòng nhập đầy đủ thông tin";
			}else{
				if(!preg_match($validate_name,$name)){
					$noti = "Họ tên không được chứa kí tự đặc biệt và số";
				}elseif(!preg_match($validate_email,$email)){
					$noti = "Tên đăng nhập không đúng , vui lòng kiểm tra lại";
				}elseif(!preg_match($validate_password,$password)){
					$noti = "Mật khẩu phải chứa tối thiểu 1 chữ cái in hoa , 1 số và 1 kí tự đặc biệt";
				}else{
					if($password != $confirm_password){
						$noti = "Mật khẩu nhập lại không khớp , vui lòng kiểm tra lại";
					}else{
						$password_hash = password_hash($password, PASSWORD_DEFAULT);
						$user = $this->models("TaiKhoanModel");
						//chuỗi ngẫu nhiên
						$makichhoat = str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz",5));
						$register = $user->addTaiKhoanUser($name,$email,$password_hash,$makichhoat,$created_at,$file,$vaitro,$status);
						if($register != "Lỗi"){
							// gửi email
							$to = $email;
							$subject = "Kích hoạt tài khoản";
							$message = "<h1> Xin chào $name </h1>
							<p> Cảm ơn bạn đã đăng ký tài khoản tại Shop Bán Hàng </p>
							<p> Để sử dụng tài khoản vui lòng kích vào đường dẫn bên dưới để kích hoạt</p>
							<p>Mã kích hoạt : </p>
							<a href='http://localhost/webbanhang-mvc/HomeController/makichhoat/$makichhoat/$register'>$makichhoat</a>";
							$header  = "From:shopbanhang@gmail.com \r\n";
							$header .= "MIME-Version: 1.0\r\n";  
							$header .= "Content-type: text/html\r\n";
							$send = mail($to,$subject,$message,$header);
							// if gửi thành công
							if($send){
								$noti = "Tài khoản đã được tạo , vui lòng check email để kích hoạt tài khoản";
							}
							else{
								$noti = "Vui lòng kiểm tra bảo mật của email để nhận được mã kích hoạt";
							}
						}else{
							$noti = "Email đã tồn tại";
						}
					}
				}
			}
		}
		$this->viewsUsers("dangky",['noti'=>$noti]);
	}

	public function logout(){
		$this->checkLogin();
		setcookie("remember" , "" , time() - (3600 * 24) , "/");
		setcookie("lifetime" , "" , time() - 900 , "/");
		// unset($_COOKIE['detailuser']);
		session_destroy(); // delete all session
		// unset($_SESSION['sanpham']);
		header("location: ../HomeController/home");
	}
}
?>