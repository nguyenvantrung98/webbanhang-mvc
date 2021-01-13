<?php
class AdminTheLoaiController extends Controller{
	public function theloai($tbao){
		if($tbao != 'Thêm thành công' && $tbao != 'Cập nhật thành công' && $tbao != 'Xóa thành công'){
			$tbao = "";
		}
			// lấy ds thể loại
		$theloai = $this->models("TheLoaiModel");
			// lấy view
		$this->viewsAdmin("view-main",["page"=>"admin-dstheloai","title"=>"Danh sách thể loại","tbao"=>$tbao,"listtheloai"=>$theloai->getAll()]);
	}

	public function themtheloai(){
		$tbao = "";
		$listdanhmuc = $this->models("DanhMucModel");
		// xử lý ảnh khi ng dùng kích vào submit
		if(isset($_POST['themtheloai'])){
			// láy thông tin của ảnh đó thông qua cái name trên thẻ input
			// bên trong file ảnh đó có name:tên file ảnh , tmp_name : tên nháp file ảnh , error , size , type..
			// kiểm tra ảnh đó có lỗi ko , ko thì tiến hành đưa ảnh vào fordel chứa 
			// lấy tên ảnh nháp di chuyển vào fordel và đè lên cái name của ảnh đó
			// kiểm tra định dạng ảnh
			// kiểm tra ảnh đó có bị trùng tên ko , có thì random 1 chuỗi 4 kí tự nối vào
			$anhdaidien = $_FILES['file'];
			$tendanhmuc = $_POST['chondanhmuc'];
			$tentheloai = $_POST['tenTheLoai'];
			$tenkhongdau = $this->xoadau($tentheloai);
			$file = './public/upload/theloai/'.$this->random().$anhdaidien['name'];
			if(file_exists($file)){
				$file = './public/upload/theloai/'.str_shuffle($this->random()).$anhdaidien['name'];
			} // đường dẫn vào ảnh
			$ngaytao = $this->ngayhientai(); // ngày giờ hiện tại
			$themtheloai = $this->models("TheLoaiModel");
			$kq = $themtheloai->addTheLoai($tentheloai,$tenkhongdau,$file,$tendanhmuc,$ngaytao);
			
			if($kq === true){
				// tiến hành move_uploaded_file khi thêm thành công
				move_uploaded_file($anhdaidien['tmp_name'],$file);
				$tbao = 'Thêm thành công';
				header("location: ./theloai/".$tbao);
				// echo "ok";
			}else{
				$tbao = 'Tên thể loại đã tồn tại';
			}
		}
		$this->viewsAdmin("view-main",["page"=>"admin-themtheloai","tbao"=>$tbao,"title"=>"Thêm thể loại",'listdanhmuc'=>$listdanhmuc->getAll()]);
	}

	public function suatheloai($id){
		$tbao = "";
		// đưa id lấy từ url qua model để thao tác vs database
		$theloaimodel = $this->models("TheLoaiModel"); // <=> new TheLoaiModel;
		$kq = $theloaimodel->getTheLoaiId($id);
		// lấy danh sách danh mục 
		$danhmucmodel = $this->models("DanhMucModel");
		$listdanhmuc = $danhmucmodel->getAll();

		// xử lý khi mà ng dùng kích vào nút sửa thể loại
		if(isset($_POST['updatetheloai'])){
			// lây dữ liệu từ server đưa qua model xử lý r trả dữ liêu ra view
			$anhdaidien = $_FILES['file'];
			// ktra xem ng dùng có chọn ảnh mới ko
			if($anhdaidien['error'] > 0){
				$file = $kq['AnhDaiDien'];
			}
			else{
				// đem ảnh bỏ vào thư mục upload và xóa ảnh cũ đi
				$file = './public/upload/test/'.$this->random().$anhdaidien['name'];
				if(file_exists($file)){
					$file = './public/upload/theloai/'.str_shuffle($this->random()).$anhdaidien['name'];
				} 
			}
			$chondanhmuc = $_POST['chondanhmuc'];
			$tentheloai = $_POST['tenTheLoai'];
			$tenkodau = $this->xoadau($tentheloai);
			$ngaysua = $this->ngayhientai();
			// echo $id;

			// gửi dữ liệu nhận được qua model xử lý
			$updatetheloai = $this->models("TheLoaiModel");
			$kq1 = $updatetheloai->updateTheLoai($tentheloai,$tenkodau,$chondanhmuc,$ngaysua,$file,$id);
				
			// kiểm tra kết quả trả về để in thông báo ra view
			if($kq1 === true){
				$tbao = "Cập nhật thành công";
				// xóa ảnh cũ
				unlink($kq['AnhDaiDien']);
				move_uploaded_file($anhdaidien['tmp_name'],$file);
				header("location: ../theloai/".$tbao);
			}else{
				$tbao = "Tên thể loại đã tồn tại";
			}
		}
		// khi xử lý xong trả kết quả về view mog muốn
		$this->viewsAdmin("view-main", ["page"=>"admin-suatheloai","title"=>"Sửa thể loại","tbao"=>$tbao,"theloai"=>$kq,"listdanhmuc"=>$listdanhmuc]);
	}

	public function xoatheloai($id){
		//theloai -> sanpham->donhang->hinhanh
		$theloai = $this->models("TheLoaiModel");
		// xóa hình trc 
		$kq = $theloai->getTheLoaiId($id);
		if(file_exists($kq['AnhDaiDien'])){
			unlink($kq['AnhDaiDien']);
		}
        // xóa thể loại
        $theloai->deleteTheLoai($id);
        $tbao = "Xóa thành công";
        header("location: ../theloai/".$tbao);
	}
}
?>