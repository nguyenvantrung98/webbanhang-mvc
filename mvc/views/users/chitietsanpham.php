<?php require_once "./mvc/models/SizeModel.php";
$sizename = new SizeModel;
require_once "./mvc/models/HinhAnhModel.php";
$picture = new HinhAnhModel;
$quantity = mysqli_num_rows($data['listcomment']);
require_once "./mvc/models/TaiKhoanModel.php";
$user = new TaiKhoanModel;
require_once "./mvc/models/BinhLuanModel.php";
$comment = new BinhLuanModel;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chi tiết sản phẩm</title>
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

	<section class="chitietsanpham" id="main">
		<div class="thongtinsanpham">
			<h1>
				<a href=""><?=$data['namedm']['TenDanhMuc']?></a> /
				<a href=""><?=$data['cate']['TenTheLoai']?></a> / 
				<span><?=$data['detailproduct']['TenSanPham']?></span>
			</h1><br>
			<div class="sp-chitiet">
				<!-- hình ảnh sản phẩm -->
				<div class="list-img">
					<?php $rs = mysqli_fetch_assoc($data['listimage']);
						$image_sp = $rs['src'];?>
					<div class="img-main">
						<img id="img-main" src="<?= $rs['src']?>">
						<!-- nếu có giảm giá thì hiển span này -->
						<?php if($data['detailproduct']['GiamGia'] > 0){?>
							<span>-<?= $data['detailproduct']['GiamGia']?>%</span>
						<?php }?>
					</div>
					<div class="img-ft">
						<?php while($rs = mysqli_fetch_assoc($data['listimage'])){?>
							<div class="hinhanh-ft">
								<img src="<?= $rs['src']?>">
								<?php if($data['detailproduct']['GiamGia'] > 0){?>
									<span>-<?= $data['detailproduct']['GiamGia']?>%</span>
								<?php }?>
							</div>
						<?php }?>
					</div>
				</div>

				<!-- thông tin sản phẩm -->
				<div class="info-sp">
					<form action="" method="post" id="formChiTietSanPham" onsubmit="return validateForm(formChiTietSanPham)">
						<div class="info">
							<input type="hidden" name="image" value="<?= $image_sp?>">
							<p><b>Tên sản phẩm : </b>
								<input type="text" name="nameproduct" readonly="readonly" value="<?= $data['detailproduct']['TenSanPham']?>" >
							</p><br>
							<!-- if có giảm giá thì in ra giá gốc và giá sau khi giảm -->
							<?php if($data['detailproduct']['GiamGia'] > 0){?>
								<p><b>Giá gốc : </b>
									<input style="text-decoration: line-through;" type="text" name="price" readonly="readonly" value="<?= number_format($data['detailproduct']['Gia'],0,",",".")?>đ" >
								</p><br>
								<!-- Số-tiền-sau-khi-giảm-giá = Giá-tiền x [(100 –  %-giảm-giá)/100] -->
								<p><b>Giá mới: </b>
									<input type="text" name="pricesale" readonly="readonly" value="<?php 
									$gia = (int)$data['detailproduct']['Gia'] * ((100-$data['detailproduct']['GiamGia']) / 100); echo number_format($gia,0,",",".")?>đ">
								</p><br>
							<?php }else{?>
								<!-- ng lại thì in ra giá bth -->
								<p><b>Giá: </b>
									<input type="text" name="price" readonly="readonly" value="<?= number_format($data['detailproduct']['Gia'],0,",",".")?>đ">
								</p><br>
							<?php }?>
							<p><b>Mô tả : </b>
								<input type="text" name="des" readonly="readonly" value="<?= $data['detailproduct']['MoTa']?>">
							</p><br>
							<!-- list size theo id sản phẩm , nếu sp đó có size thì hiện chọn size-->
							<?php if(($row = mysqli_num_rows($data['listsize'])) > 0){?>
								<p><b>Chọn size </b>
									<select class="chonSize" name="chooseSize" id="chonSize">
										<option value="">Chọn size</option>
										<?php while($rs = mysqli_fetch_assoc($data['listsize'])){
											$rss = $sizename->getSizeId($rs['size_IdSize'])?>
											<option value="<?= $rss['TenSize']?>"><?= $rss['TenSize']?></option>
										<?php }?>	
									</select>
								</p>
							<?php }?>
							<p><b>Còn : </b>
								<span><?= $data['detailproduct']['SoLuong']?> sản phẩm</span>
							</p><br>
							<p class="sl"><b>Số lượng</b></p>
							<div class="sl1">
								<div>
									<button onclick="giam()"><i class="fas fa-minus"></i></button>
									<input type="text" readonly="readonly" name="quantity" id="soLuong" min="1" value="1">
									<button onclick="tang()"><i class="fas fa-plus"></i></button>
								</div>
							</div>
						</p><br>
						<input type="hidden" name="sale" value="<?= $data['detailproduct']['GiamGia']?>">
						<div id="showthongbao"><?= $data['noti']?></div>
					</div>
					<div class="thaotac-sp">
						<br><br>
						<input type="hidden" name="idsanpham" value="1">
						<button id="addCart" name="addCart">
							Thêm vào giỏ
						</button>
						<button type="submit">
							Đặt hàng
						</button>
					</div>
				</form>
			</div>

			<div class="clear"></div>

			<!-- tin liên quan -->
			<div class="tinlienquan">
				<h1 style="color: red;">Sản phẩm tương tự</h1>
				<div class="list-tinlienquan">
					<?php while($rs = mysqli_fetch_assoc($data['products'])){?>
						<div class="info-tinlienquan">
							<a href="./SanPhamController/detailproduct/<?= $rs['IdSanPham']?>">
								<!-- lấy hình từ id sản phẩm -->
								<?php $img = $picture->getHinhAnhId($rs['IdSanPham']);
								$rss = mysqli_fetch_assoc($img);?>
								<img src="<?= $rss['src'];?>">
								<?php if($rs['GiamGia'] >0){?>
									<span class="span">-<?= $rs['GiamGia']?>%</span>
								<?php }?>
							</a>
							<div>
								<a href="./SanPhamController/detailproduct/<?= $rs['IdSanPham']?>"><p><?= $rs['TenSanPham']?></p></a>
								<p><b>Mô tả : </b><?= $rs['MoTa']?></p>
								<?php if($rs['GiamGia'] > 0){?>
									<p><b>Giá gốc : </b>
										<span style="text-decoration: line-through;"><?= number_format((int)$rs['Gia'],0,",",".")."đ"?></span>
									</p>
									<p><b>Giá mới : </b><?php $gia = (int)$rs['Gia'] * ((100-(int)$rs['GiamGia'])/ 100);
									echo number_format($gia,0,",",".")."đ";?>
								</p>
							<?php }else{?>
								<p><b>Giá : </b><?= number_format((int)$rs['Gia'],0,",",".")."đ"?></p>
							<?php }?>
						</div>
					</div>
				<?php }?>
			</div>
		</div>
	</div><br>

	<!-- bình luận -->
	<div class="binhluan">
		<div class="noidungbinhluan">
			<h1><i class="fas fa-comment-alt"></i>Bình luận</h1>
			<br>
			<form method="post">
				<textarea rows="5" placeholder="Nhập bình luận" name="comment_content" onkeyup="checkForm()" id="noidungbinhluan"></textarea>
				<br>
				<button type="submit" id="btbinhluan" name="addComment" disabled="disabled">BÌNH LUẬN</button>
			</form>
		</div>
		<?php if($quantity > 0){?>
		<div class="danhsachbinhluan">
			<h1><i class="fas fa-comments"></i>Danh sách bình luận / <span><?=$quantity?> bình luận</span></h1><br>
			<div class="list-binhluan">
				<?php foreach ($data['listcomment'] as $key => $value) { 
					$detail_user = $user->getTaiKhoanId($value['IdUser']);
					$info_user = mysqli_fetch_assoc($detail_user);
					$list_comment = $comment->getReplyCommentId($value['IdBinhLuan']);?>
					<div class="chitiet-binhluan">
						<div class="avatar">
							<img src="<?=$info_user['AnhDaiDien']?>">
						</div>
						<div class="info-user">
							<div>
								<a href=""><?=$info_user['HoTen']?></a> <span><?=$value['created_at']?></span>
							</div>
							<div class="setting">
								<span onclick="showOption(<?=$value['IdBinhLuan']?>)">...</span>
								<div class="option" id="option<?=$value['IdBinhLuan']?>">
									<?php if(isset($_SESSION['infouser'])){
										if($_SESSION['infouser']['role'] == "Người dùng"){
											if($_SESSION['infouser']['id'] == $info_user['IdUser']){ ?>
												<span onclick="showUpdate(<?=$value['IdBinhLuan']?>)">Chỉnh sửa</span>
												<span>Xóa</span>
											<?php }else{ ?>
												<span>Báo cáo</span>
											<?php }
										}else{ 
											if($_SESSION['infouser']['id'] == $info_user['IdUser']){?>
												<span>Chỉnh sửa</span>
											<?php } ?>
											<span>Xóa</span>
										<?php }
									}else{?>
										<span>Báo cáo</span>
									<?php }?>
								</div>
							</div>
							<input disabled="disabled" type="text" name="comment_content" id="comment_content<?=$value['IdBinhLuan']?>" value="<?=$value['NoiDung']?>">
							<br>
							<div class="phanhoi">
								<button onclick="showRep(<?=$value['IdBinhLuan']?>)">PHẢN HỒI</button>
							</div>

							<!-- reply -->
							<div class="noidungreply" id="noidungreply<?=$value['IdBinhLuan']?>">
								<form method="post">
									<input type="hidden" name="idcomment" value="<?=$value['IdBinhLuan']?>">
									<div class="noidungbinhluan">
										<textarea rows="5" placeholder="Nhập bình luận" name="replycomment_content"  id="replycomment<?=$value['IdBinhLuan']?>" onkeyup="checkFormReply(<?=$value['IdBinhLuan']?>)"></textarea>
									</div>
									<button id="btreply<?=$value['IdBinhLuan']?>" type="submit" name="replycomment_submit" disabled="disabled">BÌNH LUẬN</button>
									<button onclick="closeRep(<?=$value['IdBinhLuan']?>)">HỦY</button>
								</form>
							</div>

							<?php if(($row = mysqli_num_rows($list_comment)) > 0){?>
							<!-- phan hoi -->
							<a href="#" onclick="showListPhanHoi(<?=$value['IdBinhLuan']?>)"><span id="togle<?=$value['IdBinhLuan']?>">Xem</span><span> <?=$row?> bình luận</span></a>
							<br><br>
							<div id="list-reply-cmt<?=$value['IdBinhLuan']?>" class="list-reply-cmt" style="display: none">
								<?php foreach ($list_comment as $key => $val) { 
									$detail_user_rep = $user->getTaiKhoanId($val['IdUser']);
									$info_user_rep = mysqli_fetch_assoc($detail_user_rep);?>
									<div class="replycomment">
										<div class="avatar">
											<img src="<?=$info_user_rep['AnhDaiDien']?>">
										</div>
										<div class="info-user">
											<p><a href=""><?=$info_user_rep['HoTen']?></a> 
												<?php if($info_user_rep['VaiTro'] == "Admin" || $info_user_rep['VaiTro'] == "Quản trị"){?>
													<i style="font-size: 13px;font-weight: 600;color: blue">Quản trị</i>
												<?php }?>
												<span><?=$val['created_at']?></span>
											</p>
											<h5><?=$val['NoiDung']?></h5>
											<br>
											<div class="phanhoi">
												<button onclick="alert('trung');">PHẢN HỒI</button>
											</div>
										</div>
									</div>
								<?php }?>
							</div>
							<?php }?>
						</div>
					</div>
					<hr>
				<?php }?>
			</div>
		</div>
		<?php }else{?>
		<div class="giohang_empty">
		<img src = './public/img/footer/logo1.png'>
		<h1>Chưa có bình luận nào</h1>
		</div> <?php }?>
	</div>
</div>
</section>

<?php require_once "./mvc/views/users/footer.php";?>

</body>
<script src="./public/vendors/js/jquery.waypoints.min.js"></script>
<script src="./public/js/waypointchitietsp.js"></script>
<script src="./public/js/showFormGopy.js"></script>
<script src="./public/js/comment.js"></script>
<script type="text/javascript">
	// tăng giảm số lượng sp
function tang(){
	event.preventDefault();
	var soluong = document.getElementById('soLuong');
	soluong.value = parseInt(soluong.value)+1;
}

function giam(){
	event.preventDefault();
	var soluong = document.getElementById('soLuong');
	if(soluong.value <= 1){
		soluong.value = 1;
	}else
	soluong.value = parseInt(soluong.value)-1;
}

function checkForm(){
	var check = document.getElementById('noidungbinhluan').value.trim();
	var btbinhluan = document.getElementById('btbinhluan');
	if(check != ''){
		btbinhluan.removeAttribute('disabled');
		btbinhluan.style.color = 'white';
	}else{
		btbinhluan.setAttribute('disabled','disabled');
		btbinhluan.style.color = '';
	}
}
</script>
</html>