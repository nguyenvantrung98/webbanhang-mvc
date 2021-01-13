<header id="home">
	<nav id="nav">
		<div class="info-header">
			<i class="fas fa-headset">
				<a href="#" id="cskh">
					Chăm sóc khách hàng
				</a>
				<div id="list-CSKH">
					<div class="myCSKH"></div>
					<ul class="CSKH">
						<li><i class="fas fa-phone-square-alt">
						</i><a href="">0337371667</a></li>
						<li><i class="fas fa-envelope-square"></i><a href="">nguyenvantrung07tbh@gmail.com</a></li>
					</ul>
				</div>
			</i>
			<i class="fas fa-comments">
				<a style="cursor: pointer;" onclick="showFormGopy()">Góp ý</a>
			</i>
			<?php if(!isset($_SESSION['infouser'])){ ?>
				<i class="fas fa-user-plus">
					<a href="./TaiKhoanController/register">Đăng ký</a>
				</i>
				<i class="fas fa-sign-in-alt">
					<a href="./TaiKhoanController/login">Đăng nhập</a>
				</i>
			<?php }else{ ?>
				<i class="fas fa-bell">
					<a href="">Thông báo</a>
				</i>
				<i class="fas fa-user">
					<a href="#"><?=$_SESSION['infouser']['username']?></a>
					<div id="info-user">
						<ul>
							<li><a href="./HomeController/infouser/update_user"><i class="fas fa-users-cog"></i>Thông tin cá nhân</a></li>
							<li><a href="./DonHangController/follow_order"><i class="fas fa-street-view"></i>Theo dõi đơn hàng</a></li>
							<li><a href="./TaiKhoanController/change_pass"><i class="fas fa-cogs"></i>Đổi mật khẩu</a></li>
							<li><a href="./DonHangController/history"><i class="fas fa-history"></i>Lịch sử mua hàng</a></li>
							<li><a href="./TaiKhoanController/logout"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a></li>
						</ul>
					</div>
				</i>
			<?php } ?>
		</div>
		<div class="header-main">
			<div class="logo-header">
				<a href="./HomeController/home">
					<img src="./public/upload/logo/logo1.png">
				</a>
			</div>
			<div class="search-header">
				<form>
					<div class="timkiem-header">
						<input type="text" name="timkiem" placeholder="Tìm kiếm" autocomplete="off">
						<button title="Tìm kiếm" type="submit"><i class="fas fa-search"></i></button>
					</div>
				</form>
			</div>
			<div class="giohang-header" id="add">
				<div style="z-index: 1;" class="icon-giohang-header">
					<div id="gio-hang">
						<div id="mydiv"></div>
						<div id="show-giohang">
							<?php if(isset($_SESSION['addCart']) && count($_SESSION['addCart']) > 0){ ?>
							<h1>Sản phẩm đã thêm</h1>
							<hr>
							<?php }?>
							<div class="giohang123" id="giohang123">
								<!-- ktra giỏ hàng có sp chưa -->
								<?php if(isset($_SESSION['addCart']) && !empty($_SESSION['addCart'])){
									$count = 0;
									foreach ($_SESSION['addCart'] as $key => $value) {?>
											<div class="sanpham-giohang">
												<div class="img-giohang">
													<img src="<?= $value['image']?>">
												</div>
												<div class="info-sp-giohang">
													<a href="./SanPhamController/detailproduct/<?=$value['id']?>"><?= $value['nameproduct']?></a>
													<span style="text-align: center;">
														<!-- ktra sp có giảm giá ko -->
														<?php if($value['sale'] <= 0){
																echo $value['price'];
															}else{
																// xóa bỏ dấu chấm-đ đi , parse chuỗi sang int
																$price = str_replace("đ","",str_replace(".","",$value['price']));
																// tính giá giảm 
																$new_price = (int)$price * ((100-(int)$value['sale'])/100);
																echo number_format($new_price,0,",",".")."đ";
															}
														?>
													</span>
													<?php if(isset($value['size']) && !$value['size'] == 0){?>
														<p>Size : <?= $value['size']?> | Số lượng : <?= $value['quantity']?></p>
													<?php }else echo "<p>"."Số lượng : ".$value['quantity']."</p>"?>
													<a title="Xóa" style="text-align:center;" href="./GioHangController/delete/<?= $value['id']?>/<?= $value['size']?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
												</div>
											</div>
											<hr>
								<?php $count++; } }else{?>
									<img style="height: 150px" src="./public/img/footer/logo1.png">
									<div class="cart_empty">Chưa có sản phẩm</div><br><br>
								<?php }?>
							</div>
							<div class="button-giohang">
								<?php if(isset($_SESSION['addCart']) && count($_SESSION['addCart']) > 0){ ?>
									<p><?= $count;?> sản phẩm</p>
									<button><a href="./GioHangController/cart">Xem giỏ hàng</a></button>
								<?php }?>
							</div>
						</div>
					</div>

					<li>
						<a href="./GioHangController/cart"><i class="fas fa-shopping-cart"></i></a>
						<div id="ghang-icon">
							<?php if(isset($_SESSION['addCart']) && count($_SESSION['addCart']) > 0)
									echo $count;
								else echo "0";
							?>
						</div>
					</li>
				</div>

			</div>
		</div>
	</nav>
	<div id="formGopy">
		<button title="Đóng" onclick="closeFormGopy()" class="modal-close-btn" id="close-btn"><i class="fa fa-times"></i></button>
		<form action="" method="post" id="formGopY" onsubmit="return validateForm(formGopY)">
			<div>
				<img src="./public/img/footer/logo1.png">
			</div>
			<label>Họ tên</label>
			<div class="info-form">
				<i class="fas fa-user"></i>
				<input type="text" name="hoTen" placeholder="Nhập họ tên" id="hoTen" value="<?php if(isset($_SESSION['infouser']['username'])) echo $_SESSION['infouser']['username']?>">
			</div>
			<label>Số điện thoại</label>
			<div class="info-form">
				<i class="fas fa-phone-alt"></i>
				<input type="text" name="sdt" placeholder="Nhập số điện thoại" maxlength="10" id="sdt" value="<?php if(isset($_SESSION['infouser']['phone'])) echo $_SESSION['infouser']['phone']?>">
			</div>
			<label>Email</label>
			<div class="info-form">
				<i class="fas fa-envelope"></i>
				<input type="email" name="email" placeholder="Nhập email" id="email" value="<?php if(isset($_SESSION['infouser']['email'])) echo $_SESSION['infouser']['email']?>">
			</div>
			<label>Nội dung</label>>
			<textarea placeholder="Nhập nội dung muốn phản hồi hoặc góp ý" rows="5" id="noiDung" name="noiDung"></textarea>
			<div id="showthongbao1"></div>
			<div id="Gopy-PhanHoi">
				<button type="submit">
					Góp ý
				</button>
			</div>
		</form>
	</div>
</header>
