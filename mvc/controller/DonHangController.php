<?php
class DonHangController extends Controller{
	public function follow_order(){
		// check ng dùng đã login chưa
		$this->checkLogin();
		
		$order = $this->models("DonHangModel");
		$product = $this->models("SanPhamModel");
		// list đơn hàng
		// status 0 : đang chờ và đang giao ; 1 : đã nhận , 2 : all order và đã hủy
		$listOrder = $order->getDonHangIdUser($_SESSION['infouser']['id'],0);
		$listOrdered = $order->getDonHangIdUser($_SESSION['infouser']['id'],1);
		$listOrder_Product = [];
		$listOrdered_Product = [];
		// list sp_donhang
		foreach ($listOrder as $key => $value) {
			$listOrder_Product[$key] = $product->getSanPhamIdDonHang($value['IdDonHang']);
		}

		foreach ($listOrdered as $key => $value) {
			$listOrdered_Product[$key] = $product->getSanPhamIdDonHang($value['IdDonHang']);
		}

		$this->viewsUsers("theodoidonhang",['listOrder'=>$listOrder,'listOrder_Product'=>$listOrder_Product,'listOrdered'=>$listOrdered,'listOrdered_Product'=>$listOrdered_Product]);
	}

	public function cancel_order($id){
		// check ng dùng đã login chưa
		$this->checkLogin();

		$order = $this->models("DonHangModel");
		$cancel_order = $order->huydon($id,$this->ngayhientai());
		if($cancel_order){
			header("location: ../follow_order");
		}
	}

	public function confirm_order($id){
		$this->checkLogin();
		$order = $this->models("DonHangModel");
		$confirm_order = $order->updateDonHang($id,2);
		if($confirm_order){
			header("location: ../follow_order");
		}
	}

	public function history(){
		$this->checkLogin();
		$order = $this->models("DonHangModel");
		$product = $this->models("SanPhamModel");

		// list đơn hàng
		$listOrder = $order->getDonHangIdUser($_SESSION['infouser']['id'],2);
		$listOrder_Product = [];
		if(mysqli_num_rows($listOrder) > 0){
			foreach ($listOrder as $key => $value) {
				$listOrder_Product[$key] = $product->getSanPhamIdDonHang($value['IdDonHang']);
			}
		}

		$this->viewsUsers("lichsumuahang",['listOrder'=>$listOrder,'listOrder_Product'=>$listOrder_Product]);
	}

	public function delete_order($id){
		$this->checkLogin();
		$order = $this->models("DonHangModel");
		$order->deleteDonHang($id);
		header("location: ../history");
	}
}
?>