<?php 
	class AdminGopYController extends Controller{
		public function gopy($noti){
			if($noti != "Xóa thành công"){
				$noti = "";
			}else{
				$noti = $noti;
			}
			$contact = $this->models("GopYModel");
			$user = $this->models("TaiKhoanModel");
			$list_contact = $contact->getAll();
			$list_detail_user = [];

			foreach ($list_contact as $key => $value) {
				$list_detail_user[$key] = $user->getTaiKhoanId($value['IdUser']);
			}

			$this->viewsAdmin("view-main",["page"=>"admin-dsgopy-phanhoi","listcontact"=>$list_contact,'list_detail_user'=>$list_detail_user,"title"=>"Danh sách góp ý & phản hồi" , "noti"=>$noti]);
		}


		public function delete_contact($id){
			$contact = $this->models("GopYModel");
			$contact->deletePhanHoi($id);
			$noti = "Xóa thành công";
			header("location: ../gopy/".$noti);
		}
	}
?>