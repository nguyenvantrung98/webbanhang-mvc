<?php 
class SanPhamController extends Controller{
	public function detailproduct($id){
		$noti = "";
		$category = $this->models("TheLoaiModel");
		$product = $this->models("SanPhamModel");
		$image = $this->models("HinhAnhModel");
		$size = $this->models("SizeModel");
		$danhmuc = $this->models("DanhMucModel");
		$comment = $this->models("BinhLuanModel");
		$user = $this->models("TaiKhoanModel");

		// lấy thông tin sản phẩm theo id
		$detailproducts = $product->getSanPhamId($id);
		$detailproduct = mysqli_fetch_assoc($detailproducts);
		// kiểm tra nếu ng dùng nhập 1 cái id ko có tồn tại trong db
		if($detailproducts->num_rows == 0){
			header("location: http://localhost/webbanhang-mvc/HomeController/home");
		}
		// từ id sản phẩm lấy ra đc hình ảnh , thể loại , size
		$listimages = $image->getHinhAnhId($id);
		$listsize = $size->getListSizeIdSp($id);
		$cate = $category->getTheLoaiId($detailproduct['IdTheLoai']);
		// từ id thể loại lấy ra đc danh mục , sản phẩm liên quan
		$namedm = $danhmuc->getNameDanhMucId($cate['IdDanhMuc']);
		// lấy ra 4 sp liên quan theo id thể loại
		$products = $product->getSanPhamLienQuanId($cate['IdTheLoai'],$id);
		$list_comment = $comment->getCommentId($id);
		
		// xử lý khi ng dùng add sản phẩm vào giỏ
		if(isset($_POST['addCart'])){
			// ktra xem ng dùng đã login chưa
			// $this->checkLogin();
			if(isset($_POST['chooseSize']) && $_POST['chooseSize'] == ""){ // ktra sp đó có size để chọn ko
				$noti = "Vui lòng chọn size";
			}else{ // sản phẩm ko có size để chọn
				if(isset($_POST['chooseSize']) && $_POST['chooseSize'] != ""){
					$size = $_POST['chooseSize'];
				}elseif(!isset($_POST['chooseSize'])){
					$size = 0;
				}
				// ktra sản phẩm đã tồn tại trong giỏ hàng chưa
				if(isset($_SESSION['addCart'][$id.$size])){
					// rồi thì tăng số lượng sp lên
					$_SESSION['addCart'][$id.$size]['quantity'] += $_POST['quantity'];
				}else{
					// đưa dữ liệu nhận về lên session
					$_SESSION['addCart'][$id.$size] = array(
						"id" => $id,
						"image" => $_POST['image'],
						"size" => $size,
						"sale" => $_POST['sale'],
						"price" => $_POST['price'],
						"nameproduct" => $_POST['nameproduct'],
						"des" => $_POST['des'],
						"quantity" => $_POST['quantity']
					);
				}
				$noti = "Đã thêm vào giỏ";
			}
		}

		// xử lý khi ng dùng thêm bình luận
		if(isset($_POST['addComment'])){
			// bắt buộc phải đăng nhập ms đc comment
			$this->checkLogin();
			$comment = $this->models("BinhLuanModel");
			$iduser = $_SESSION['infouser']['id'];
			$date = $this->ngayhientai();
			$comment_content = $this->test_input($_POST['comment_content']); // làm sạch dữ liệu ng dùng nhập vào
			if($comment_content == ""){
				$noti = "Bạn chưa nhập nội dung bình luận";
			}else{
				$result = $comment->addComment($comment_content,$iduser,$id,$date);
				if($result){
					header("location: ../detailproduct/".$id);
					exit();
				}else{
					$noti = "Xảy ra lỗi , vui lòng thử lại sau";
				}
			}
		}

		// xử lý khi ng dùng thêm rep comment
		if(isset($_POST['replycomment_submit'])){
			// bắt buộc phải đăng nhập ms đc comment
			$this->checkLogin();
			$comment = $this->models("BinhLuanModel");
			$idcomment = $_POST['idcomment'];
			$iduser = $_SESSION['infouser']['id'];
			$date = $this->ngayhientai();
			$replycomment_content = $this->test_input($_POST['replycomment_content']); // làm sạch dữ liệu ng dùng nhập vào
			if($replycomment_content == ""){
				$noti = "Bạn chưa nhập nội dung bình luận";
			}else{
				$result = $comment->addRepComment($replycomment_content,$iduser,$idcomment,$date);
				if($result){
					header("location: ../detailproduct/".$id);
					exit();
				}else{
					$noti = "Xảy ra lỗi , vui lòng thử lại sau";
				}
			}
		}

	$this->viewsUsers("chitietsanpham",['cate'=>$cate,'detailproduct'=>$detailproduct,'listimage'=>$listimages,'listsize'=>$listsize,'namedm'=>$namedm,'products'=>$products,'listcomment'=>$list_comment,'noti'=>$noti]);
	}
}