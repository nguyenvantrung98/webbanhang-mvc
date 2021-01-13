<?php 
	class AdminBinhLuanController extends Controller{
		public function binhluan($noti){
			if($noti != "Xóa thành công"){
				$noti = "";
			}else{
				$noti = $noti;
			}
			$comment = $this->models("BinhLuanModel");
			$user = $this->models("TaiKhoanModel");
			$product = $this->models("SanPhamModel");
			$listcomment = $comment->getAll();
			$list_detail_user = [];
			$list_detail_product = [];
			foreach ($listcomment as $key => $value) {
				$list_detail_user[$key] = $user->getTaiKhoanId($value['IdUser']);
				$list_detail_product[$key] = $product->getSanPhamId($value['IdSanPham']);
			}
			
			$this->viewsAdmin("view-main",["page"=>"admin-dsbinhluan","listcomment"=>$listcomment,"title"=>"Danh sách bình luận","noti"=>$noti,'list_detail_user'=>$list_detail_user,'list_detail_product'=>$list_detail_product]);
		}

		public function xoabinhluan($id){
			$comment = $this->models("BinhLuanModel");
			$comment->deleteBinhLuan($id);
			$noti = "Xóa thành công";
			header("location: ../binhluan/".$noti);
		}
	}
?>