<?php
class AdminSanPhamController extends Controller{
	public function sanpham($tbao){
		$listsanpham = $this->models("SanPhamModel");
		$kq = $listsanpham->getAll();
		$thongbao = "";

		if($tbao == 'Thêm thành công' || $tbao == 'Cập nhật thành công' || $tbao == 'Xóa thành công'){
			$thongbao = $tbao;
		}else if($tbao == 'danhsachsale'){
			$kq = $listsanpham->getSanPhamGiamGia();
		}
		
		$this->viewsAdmin("view-main",["page"=>"admin-dssanpham","title"=>"Danh sách sản phẩm","listsanpham"=>$kq,"tbao"=>$thongbao]);
	}


	// thêm sản phẩm
	public function themsanpham(){
		$tbao = "";
		// lấy danh sách thể loại
		$theloai = $this->models("TheLoaiModel");
		$tl = $theloai->getAll();

		// lấy danh sách kiểu size
		$kieusize = $this->models("KieuSizeModel");
		$ks = $kieusize->getAll();

		// xử lý khi ng dùng kích thêm sản phẩm
		if(isset($_POST['addsanpham'])){
			// ktra thông tin ng dùng nhập để update có ok chưa , rồi thì thực hiện xử lý ảnh , ko thì dừng ngay
			// xử lý thông tin chi tiết
			$tentheloai = $_POST['tenTheLoai'];
			$tensanpham = $_POST['tenSp'];
			$tenkhongdau = $this->xoadau($tensanpham);
			$mota = $_POST['moTa'];
			$gia = $_POST['gia'];
			$soluong = $_POST['soLuong'];
			$giamgia = $_POST['giamgia'];
			$chonkieusize = $_POST['chonkieusize'];
			$ngaytao = $this->ngayhientai();

			if(isset($_POST['size'])){
				$size = $_POST['size'];
			}else{
				$size = [];
			}

			// gửi dữ liệu nhận đc qua model để xử lý vs database
			$sanpham = $this->models("SanPhamModel");
			$kq = $sanpham->addSanPham($tensanpham,$tenkhongdau,$mota,$gia,$soluong,$giamgia,$tentheloai,$chonkieusize,$ngaytao);
			if($kq != "Lỗi"){
				//lấy id mới khi insert thành công
				// echo $kq
				// xử lý ảnh
				// hình chính
				$hinh1 = $_FILES['file-main'];
				$file1 = './public/upload/sanpham/'.$this->random().'1'.$hinh1['name'];
				if(file_exists($file1)){
					$file1 = './public/upload/sanpham/'.str_shuffle($this->random()).'1'.$hinh1['name'];
				}
				$hinhanh = $this->models("HinhAnhModel");
				// thêm hình ảnh
				$anh1 = $hinhanh->addHinhAnhId($file1,$kq);
				move_uploaded_file($hinh1['tmp_name'],$file1);
				
				// hình phụ
				for($i = 2 ; $i < 6 ; $i++){
					$hinh = $_FILES['img-phu'.$i];
					$file = './public/upload/sanpham/'.$this->random().$i.$hinh['name'];
					if(file_exists($file)){
						$file = './public/upload/sanpham/'.str_shuffle($this->random()).$i.$hinh1['name'];
					}
					$anh = $hinhanh->addHinhAnhId($file,$kq);
					move_uploaded_file($hinh['tmp_name'],$file);
				}

				$size_sp = $this->models("SizeModel");
					// lấy các size mà ng dùng chọn thêm xún database
				if(!empty($size)){
					foreach ($size as $value) {
						$kq1 = $size_sp->addSize1($kq,$value);
					}
				}
				// ok hết r thì in ra thông báo
				$tbao = "Thêm thành công";
				header("location: ./sanpham/".$tbao);
			}else{
				$tbao = "Tên sản phẩm đã tồn tại";
			}
		}

		$this->viewsAdmin("admin-themsanpham",["listtheloai"=>$tl,"listkieusize"=>$ks,"tbao"=>$tbao]);
	}


	// sửa sản phẩm
	public function suasanpham($id){
		$tbao = "";
			// lấy thông tin sản phẩm
		$sanpham = $this->models("SanPhamModel");
		$chitietspp = $sanpham->getSanPhamId($id);
		$chitietsp = mysqli_fetch_assoc($chitietspp);

			// lấy danh sách thể loại đổ vào select
		$theloai = $this->models("TheLoaiModel");
		$tl = $theloai->getAll();

		// lấy 1 hình ảnh theo id sp
		$hinhanh = $this->models("HinhAnhModel");
		$hinh1 = $hinhanh->getHinhAnhIdSanPham($id);
		// lấy hình ảnh theo id sp
		$hinh2 = $hinhanh->getListHinhAnhId($id);
		
		// lấy danh sách kiểu size
		$kieusize = $this->models("KieuSizeModel");
		$ks = $kieusize->getAll();

			// lấy danh sách size theo id kiểu size
		$size = $this->models("SizeModel");
		$sz = $size->getListSizeId($chitietsp['IdKieuSize']);

			// lấy danh sách size thuộc sản phẩm đó
		$sizesp = $size->getListSizeIdSp($id);

		// xử lý khi ng dùng kích submit
		if(isset($_POST['updatesanpham'])){
			// lưu thông tin sản phảm trc r xử lý hình sau
			$tentheloai = $_POST['tenTheLoai'];
			$tensanpham = $_POST['tenSp'];
			$tenkhongdau = $this->xoadau($tensanpham);
			$mota = $_POST['moTa'];
			$gia = $_POST['gia'];
			$soluong = $_POST['soLuong'];
			$giamgia = $_POST['giamgia'];
			$chonkieusize = $_POST['chonkieusize'];
			$ngaysua =$this->ngayhientai();
			// đưa dữ liệu qua model xử lý
			$kq = $sanpham->updateSanPham($tensanpham,$tenkhongdau,$mota,$gia,$soluong,$giamgia,$tentheloai,$chonkieusize,$ngaysua,$id);
			if($kq === true){
				// xử lý ảnh
				// hình chính
				$img1 = $_FILES['file-main'];
				// nếu ng dùng k chọn ảnh mới thì ko update , còn có thì ms update
				if($img1['error'] > 0){
					
				}else{
					// Lấy ảnh
					// Lấy 1 ảnh đầu tiên ra
					$rs1 = mysqli_fetch_assoc($hinh1);
					$id1 = $rs1['IdHinhAnh'];
					$file1 = './public/upload/sanpham/'.$this->random().'1'.$img1['name'];
					if(file_exists($file1)){
						$file1 = './public/upload/sanpham/'.str_shuffle($this->random()).'1'.$img1['name'];
					}
					$kq = $hinhanh->updateHinhAnh($id1,$file1);
					// xóa ảnh cũ
					unlink($rs1['src']);
					move_uploaded_file($img1['tmp_name'],$file1);
				}
				
				// hình phụ
				// khi ng dùng submit sẽ lấy 4 ảnh còn lại ra từ database lên để so sánh
				// hình phụ
				$i=2;
				while ($image = mysqli_fetch_assoc($hinh2)){
					$img = $_FILES['img-phu'.$i];
					if($img['error'] > 0){

					}else{
						$id = $image['IdHinhAnh'];
						$file = './public/upload/sanpham/'.$this->random().$i.$img['name'];
						if(file_exists($file)){
							$file = './public/upload/sanpham/'.str_shuffle($this->random()).$i.$img['name'];
						}
						$kq = $hinhanh->updateHinhAnh($id,$file);
							// xóa ảnh cũ
						unlink($image['src']);
						move_uploaded_file($img['tmp_name'],$file);
					}
					$i++;
				}
				
				// nếu ng dùng chọn size thì xử lý , ko thì thôi
				if(isset($_POST['size'])){
					// xóa các size gốc rồi lấy size hiện tại bỏ dô
					$kq = $size->xoaSize($id);
					// lấy các size mà ng dùng chọn thêm xún database
					foreach ($_POST['size'] as $value) {
						$kq1 = $size->addSize1($id,$value);
					}
				}
				// ok hết r thì in ra thông báo
				$tbao = "Cập nhật thành công";
				header("location: ../sanpham/".$tbao);
			}else{
				$tbao = "Tên sản phẩm đã tồn tại";
			}
		}

		$this->viewsAdmin("admin-suasanpham",["chitietsanpham"=>$chitietsp,"imagemain"=>$hinh1,'listimg'=>$hinh2,"listtheloai"=>$tl,"listkieusize"=>$ks,"listsize"=>$sz,"listsizesp"=>$sizesp,"tbao"=>$tbao]);
	}


		// xử lý khi ng dùng chọn kiểu size mới , load các size thuộc id kiểu đó ra
	public function loadsize($idkieusize,$idsanpham){
		$size = $this->models("SizeModel");
		// là sửa sản phẩm
		if($idsanpham != "trung"){
				// lấy danh sách kiểu szie theo id sản phẩm
			$sizesp = $size->getListSizeIdSp($idsanpham);
				// lấy ra danh sách size theo idkieusize
			$listsize = $size->getListSizeId($idkieusize);
			while($rs = mysqli_fetch_assoc($listsize)){ ?>
				<div class="chonsize">
					<!-- kiểm tra size dó có thuộc sản phẩm này ko -->
					<input <?php while($sz = mysqli_fetch_assoc($sizesp)){ if($sz['size_IdSize'] == $rs['IdSize']){ echo "checked = 'checked'"; break;}} ?> type="checkbox" name="size[]" value="<?=$rs['IdSize']?>">
					<label>Size <?=$rs['TenSize']?></label>
				</div>
			<?php }
		}
		else{ // thêm sản phẩm
			// lấy ra danh sách size theo idkieusize
			$listsize = $size->getListSizeId($idkieusize);
			// var_dump($listsize);
			while($rs = mysqli_fetch_assoc($listsize)){ ?>
				<div class="chonsize">
					<input type="checkbox" name="size[]" value="<?=$rs['IdSize']?>">
					<label>Size <?=$rs['TenSize']?></label>
				</div>
			<?php }
		}
	}

	public function xoasanpham($id){
		$sanpham = $this->models("SanPhamModel");
		
		// xóa sản phẩm
		$sanpham->deleteSanPham($id);
		$tbao = "Xóa thành công";
        header("location: ../sanpham/".$tbao);
	}
}
?>