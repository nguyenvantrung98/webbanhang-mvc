<!DOCTYPE html>
<html>
<head>
	<title>Danh sách sẩn phẩm</title>
	<meta charset="UTF-8">
	<meta name="mota" content="Danh sách sản phẩm">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<base href="http://localhost/webbanhang-mvc/HomeController">
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<link rel="stylesheet" href="./public/vendors/css/grid.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="./public/img/footer/logo1.png"/>
	<meta name="tukhoa" content="Quan-ao,Giay-dep,Phu-kien">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="tacgia" content="Nguyễn Văn Trung">
</head>
<body>
	<?php require_once "./mvc/views/users/header.php";?>

	<section class="danhsachtheloai" id="main">
		<div class="content-theloai">
			<div class="list-menu">
				<!-- ten danh muc -->
				<ul id="menu-dm" onclick="showmn()">
					<li>
						<p><i class="fas fa-list"></i> Quần Áo / 
							<span style="color: red"><?php echo $data['title']?></span>
						</p>
					</li>
				</ul>
				<!-- list the loai thuoc danh muc tren -->
				<ul id="theloaids">
					<?php while($category = mysqli_fetch_assoc($data['listcategory'])){?>
					<li class="list-group-item menu1">
						<a href="./TheLoaiController/categories/<?php echo $category['TenKhongDau']?>"><?php echo $category['TenTheLoai']?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			<div class="null"></div>
			<div class="chitiettheloai">
				<?php foreach ($data['listproduct'] as $key => $value) { ?>
					<div class="chitiet">
						<a href="./SanPhamController/detailproduct/<?=$value['IdSanPham']?>">
							<?php foreach ($data['list_image'][$key] as $img) {?>
								<img src="<?=$img['src'];?>">
							<?php }?>
						</a>
						<div class="mota">
							<a href="./SanPhamController/detailproduct/<?=$value['IdSanPham']?>">
								<?=$value['TenSanPham']?>
							</a>
							<p>Giá : <?= number_format($value['Gia'],0,",",".")."đ"?></p>
							<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
		<!-- <br>
		<div class="tinlienquan">
			<h1>Sản phẩm tương tự</h1>
			<div class="ds-tinlienquan">
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
				<div class="chitiet-tinlienquan">
					<a href=""><img src="./img/sanpham/sp1.jpg"></a>
					<div class="mota">
						<a href="">Ao so mi nam</a>
						<p>Gia : 200.000</p>
						<button><i class="fas fa-shopping-cart"></i></button> | <button>Mua ngay</button>
					</div>
				</div>
			</div>
		</div> -->
	</section>

	<?php require_once "./mvc/views/users/footer.php";?>
	
	
</body>
<script src="../public/vendors/js/jquery.waypoints.min.js"></script>
<script src="../public/js/scripts.js"></script>
<script src="../public/js/showFormGopy.js"></script>
<script type="text/javascript">
	function showmn(){
		var a = document.getElementById('theloaids');
		if(a.style.display == 'none'){
			a.style.display ='block';
		}else{
			a.style.display ='none';
		}
	}
</script>
</html>