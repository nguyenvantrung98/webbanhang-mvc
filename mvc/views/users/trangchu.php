<?php require_once "./mvc/models/HinhAnhModel.php";
$picture = new HinhAnhModel;
require_once "./mvc/models/TheLoaiModel.php";
$category = new TheLoaiModel;
// print_r(explode("/",filter_var(trim("HomeController/home/trung", "/"))));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop Bán Hàng</title>
	<meta charset="UTF-8">
	<meta name="mota" content="Danh sách sản phẩm">
	<base href="http://localhost/webbanhang-mvc/HomeController">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<link rel="stylesheet" href="./public/vendors/css/grid.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="./public/img/footer/logo1.png"/>
	<meta name="tukhoa" content="Quan-ao,Giay-dep,Phu-kien">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="tacgia" content="Nguyễn Văn Trung">
	<style type="text/css">
		.slide{
			-webkit-animation-name: slide;
			-webkit-animation-duration: 1.5s;
			animation-name: slide;
			animation-duration: 1.5s;
		}

		@-webkit-keyframes slide {
			from {opacity: .4} 
			to {opacity: 1}
		}

		@keyframes slide {
			from {opacity: .4} 
			to {opacity: 1}
		}
	</style>
</head>
<body>
	<?php require_once "./mvc/views/users/header.php";?>

	<div id="menu">
		<ul>
			<?php foreach ($data['listcategories'] as $value) { ?>
				<li><a style="cursor: pointer;"><?php echo strtoupper($value['TenDanhMuc']);
				$categories = $category->getTheLoaiIdDanhMuc($value['IdDanhMuc']);?></a>
				<ul class="sub-menu">
					<?php while($categorys = mysqli_fetch_assoc($categories)){?>
						<li><a href="./categories"><?php echo $categorys['TenTheLoai']?></a></li>
					<?php }?>
				</ul>
			</li>
		<?php }?>
		</ul>
	</div>

	<section class="main" id="main">
		<section class="slider">
			<div class="khoi-slide">
				<div class="cac-slide">
					<!-- slide -->
					<?php foreach ($data['listslide'] as $key => $value) { ?>
						<div class="slide active">
							<img src="<?=$value['Hinh']?>">
						</div>
					<?php }?>
				</div>
				
				<div class="quangcao">
					<div class="quangcao1">
						<img style="height: 100%;" src="./public/upload/slide/u4xibnoel1-12-2020.jpg">
					</div>
					<div class="quangcao-hr"></div>
					<div class="quangcao2">
						<img style="height: 100%;" src="./public/upload/slide/vijvknoel-12-2020.jpg">
					</div>
				</div>
			</div>
		</section>
		<section class="danhmuc">
			<div class="hder">
				<div class="ten-hder">DANH SÁCH THỂ LOẠI</div>
				<a href="./TheLoaiController/categories/list">Xem Tất Cả<i class="fas fa-chevron-right"></i></a>
			</div>
			<br>
			<!-- <button>toi</button> -->
			<i id="pre" onclick="pre()"class="fas fa-caret-left"></i>
			<i id="next" onclick="next()" class="fas fa-caret-right"></i>
			<div style="left: 0" class="row danhsachdanhmuc" id="danhsachdanhmuc">
				<?php while($category = mysqli_fetch_assoc($data['listcategory'])){ ?>
					<div class="hinhanh-danhmuc">
						<a href="./TheLoaiController/categories/<?php echo $category['TenKhongDau']?>">
							<img class="img-sp" src="<?php echo $category['AnhDaiDien']?>" alt="activities1">
						</a>
						<p class="content">
							<a href="./TheLoaiController/categories/<?php echo $category['TenKhongDau']?>"><?php echo $category['TenTheLoai']?></a>
						</p>
					</div>
				<?php } ?>
			</div>
			<!-- <h1>danh sach the loai</h1> -->
		</section>
		<section class="noibat">
			<div class="hder">
				<div class="ten-hder">SẢN PHẨM NỔI BẬT</div>
				<a href="./TheLoaiController/categories/list">Xem Tất Cả<i class="fas fa-chevron-right"></i></a>
			</div>
			<div class="row danhsachnoibat">
				<?php while($product = mysqli_fetch_assoc($data['listproduct'])){ ?>
					<div class="hinhanh-noibat">
						<a href="./SanPhamController/detailproduct/<?php echo $product['IdSanPham']?>">
							<?php $images = $picture->getHinhAnhId($product['IdSanPham']);
							$image = mysqli_fetch_assoc($images);
							?>
							<img class="img-sp" src="<?php echo $image['src']?>" id="sanpham1" alt="activities1">
						</a>
						<div class="content1">
							<a><?php echo $product['TenSanPham']?></a>
							<p>Giá : <?php echo number_format($product['Gia'],0,",",".")."đ";?></p>
							<br>
							<div>
								<a href="./SanPhamController/detailproduct/<?php echo $product['IdSanPham']?>">Xem chi tiết</a>
							</div>
						</div>
						<div id="thongbao"></div>
						<span>HOT</span>
					</div>
				<?php } ?>
			</div>
		</section>
		<section class="hotsale">
			<div class="hder">
				<div class="ten-hder">HOT SALE</div>
				<a href="./TheLoaiController/categories/list">Xem Tất Cả<i class="fas fa-chevron-right"></i></a>
			</div>
			<div class="row danhsachhotsale">
				<?php while($product = mysqli_fetch_assoc($data['listproductsale'])){?>
					<div class="hinhanh-hotsale">
						<a href="./SanPhamController/detailproduct/<?php echo $product['IdSanPham']?>">
							<?php $images = $picture->getHinhAnhId($product['IdSanPham']);
							$image = mysqli_fetch_assoc($images);
							?>
							<img class="img-sp" src="<?php echo $image['src']?>" alt="activities1">
						</a>
						<div class="content1">
							<a><?php echo $product['TenSanPham']?></a>
							<p>Giá : <?php echo number_format($product['Gia'],0,",",".")."đ";?></p><br>
							<div>
								<a href="./SanPhamController/detailproduct/<?php echo $product['IdSanPham']?>">Xem chi tiết</a>
							</div>
						</div>
						<span>-<?php echo $product['GiamGia']?>%</span>
					</div>
				<?php }?>
			</div>
		</section>

		<section class="dichvu">
			<h1>DỊCH VỤ KHÁCH HÀNG</h1>
			<div class="thaotac-dichvu">
				<div class="khuyenmai-dv">
					<img src="./public/upload/logo/khuyenmai.png">
					<div class="content-dv">
						<a href="">KHUYẾN MÃI</a>
						<br>
						<p>
						Khuyến mãi hàng tháng với các mẫu siêu đẹp , siêu rẻ dành cho cả nam và nữ.</p>
					</div>
				</div>
				<div class="giaohangtannoi-dv">
					<img src="./public/upload/logo/giaohangtannoi.png">
					<div class="content-dv">
						<a href="">GIAO HÀNG TẬN NHÀ</a>
						<br>
						<p>
						Liên kết với các hãng giao hàng trên toàn quốc , hỗ trợ giao hàng tận nơi trên tất cả các tỉnh thành.</p>
					</div>
				</div>
				<div class="baohanh-dv">
					<img src="./public/upload/logo/baohanh1.jpg">
					<div class="content-dv">
						<a href="">BẢO HÀNH</a>
						<br>
						<p>
						Hỗ trợ đổi trả hàng nếu không vừa ý , với điều kiện trước 5 ngày và sản phẩm phải còn nguyên vẹn.</p>
					</div>
				</div>
				<div class="uudai-dv">
					<img src="./public/upload/logo/uudai.png">
					<div class="content-dv">
						<a href="">ƯU ĐÃI THÀNH VIÊN</a>
						<br>
						<p>
						Chương trình mua đồ tích điểm áp dụng cho các khách hàng quen thuộc</p>
					</div>
				</div>
			</div>
		</section>
	</section>

	<?php require_once "./mvc/views/users/footer.php";?>
</body>
<script src="./public/js/slide-menu.js"></script>
<script src="./public/js/validate-form.js"></script>
<script src="./public/vendors/js/jquery.waypoints.min.js"></script>
<script src="./public/js/scripts.js"></script>
<script src="./public/js/showFormGopy.js"></script>
<script type="text/javascript">
	function themvaogio(id,product,des,price){
		console.log(id);
		// console.log(img);
		console.log(des);
		console.log(price);
		console.log(product);
		$.ajax({
			type : 'GET',
			url : "./GioHangController/addcart/"+id+"/"+product+"/"+des+"/"+price,
			data : id,
			success : function(data){
 				// console.log(data);
 				$('#thongbao').html(data);
 			}
 		});
	}
</script>
</html>