<?php 
class GioHangController extends Controller{
	public function cart(){
		$noti = "";
		// ktra xem ng dùng đã login chưa
		// $this->checkLogin();

		// khi ng dùng kích đặt hàng
		if(isset($_POST['order'])){
			$noti = "";
			// ktra đơn hàng có sp chưa , rồi thì xóa đi r thêm vào lại
			if(isset($_SESSION['order_product'])){
				unset($_SESSION['order_product']);
			}
			// xử lý khi ng dùng nhấn chọn sp để order
			if(isset($_POST['checkbox'])){ // list id sản phẩm khi ng dùng chọn
				$quantity = $_POST['quantity']; // số lượng sp mà ng dùng chọn tại trang giỏ hàng => array
				$total_money = $_POST['total_money'];
				foreach ($_POST['checkbox'] as $value) { // sp đc chọn
					foreach ($quantity as $key => $values) {
						if($value == $key){
							$_SESSION['addCart'][$key]['quantity'] = $values;//update lại th/tin sản phẩm trong giỏ hàng
							// tạo session chứa thông tin sản phẩm order
							$_SESSION['order_product'][$value] = $_SESSION['addCart'][$value];
							break;
						}
					}
				}
				// set tổng tiền vào session
				$_SESSION['total_money'] = $total_money;
				header("location: ../HomeController/infouser/update_product");
			}else{ // chưa chọn
				$noti = "Bạn chưa chọn sản phẩm";
			}
		}

		$this->viewsUsers("giohang",['noti'=>$noti]);
	}

	public function order($check){
		// ktra đăng nhập
		$this->checkLogin();
		// kiểm tra mã có chính xác ko
		if($check == $_SESSION['check']){
			// khi ng dùng đặt hàng
			if(isset($_POST['order_product'])){
				// thêm dữ liệu xún db
				$order = $this->models("DonHangModel");
				$status = 0;
				$idUser = $_SESSION['infouser']['id'];
				$date_order = $this->ngayhientai();
				// format total price
				$total = str_replace("đ","",str_replace(".","",$_SESSION['total_money']));
				$total_money = number_format((int)$total+30000,0,",",".")."đ";
				$id_products = $_SESSION['order_product']; // => array : thông tin sản phẩm
				$result = $order->addDonHang($status,$idUser,$date_order,$total_money,$id_products);
				if($result){
					unset($_SESSION['order_product']);
					unset($_SESSION['check']);
					unset($_SESSION['total_money']);
					header("location: http://localhost/webbanhang-mvc/DonHangController/follow_order");
				}
			}
			$this->viewsUsers("dathang");
		}else{
			header("location: http://localhost/webbanhang-mvc/HomeController/home");
		}
	}

	public function delete($id,$size){
		unset($_SESSION['order_product']);
		unset($_SESSION['check']);
		unset($_SESSION['total_money']);
		unset($_SESSION['addCart'][$id.$size]); // xóa sp theo key
		// if sp trong giỏ = 0 thì xóa luôn cái giỏ
		if(count($_SESSION['addCart']) == 0){
			unset($_SESSION['addCart']);
		};
		header("location: http://localhost/webbanhang-mvc/GioHangController/cart");
	}
}
?>