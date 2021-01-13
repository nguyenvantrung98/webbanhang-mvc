<!DOCTYPE html>
<html>
<head>
	<title>Cập nhật sản phẩm</title>
	
	<?php include('admin-header.php');?>

	<section class="main-admin">
		<?php include('admin-menu.php');?>

		<div id="content-admin">
			<h1>Sản phẩm / <span>Chỉnh sửa</span></h1>
			<hr>
			<br>
			<form action="" id="formSanPham" method="post" enctype="multipart/form-data" onsubmit="return validateForm(formSanPham)">
				<div class="content-main-themsp">
					<div class="img-themsp">
						<div class="img-main-themsp">
							<div title="Ảnh" class="themsp-img">
								<input accept="image/*" type="file" name="file-main" id="hinhanh1" onchange="onChange(1)" />
								<img id="spam1" class="img" src="<?=mysqli_fetch_assoc($data['imagemain'])['src']?>">
								<label for="hinhanh1" id="label1" class="label">
									<i class="fas fa-folder-plus"></i><b>Nhấp chọn ảnh</b>
								</label>
							</div>
						</div>
						<div class="imgs-phu-themsp">
							<?php 
							$i = 2;
							foreach ($data['listimg'] as $key => $value) {?>
								<div title="Ảnh <?=$i?>" class="img-phu">
									<input accept="image/*" type="file" name="img-phu<?=$i?>" id="hinhanh<?=$i?>" onchange="onChange(<?=$i?>)">
									<img name="img<?=$i;?>" id="spam<?=$i?>" class="img" src="<?=$value['src']?>">
									<label for="hinhanh<?=$i?>" id="label<?=$i?>" class="label"><i class="fas fa-folder-plus"></i>Nhấp chọn ảnh</label>
								</div>
							<?php $i++;
								} ?>
						</div>
					</div>
					<div class="mota-themsp">
						<label><b>Tên thể loại</b></label>
						<select name="tenTheLoai" id="tenTheLoai">
							<?php
								// lấy ds thể loại
							while($tl = mysqli_fetch_assoc($data['listtheloai'])){ ?>
								<option <?php if($data['chitietsanpham']['IdTheLoai'] == $tl['IdTheLoai']) echo "selected = 'selected'"?> value="<?php echo $tl['IdTheLoai']?>"><?php echo $tl['TenTheLoai']?></option>
							<?php }
							?>
						</select>
						<input type="hidden" name="idhidden" id="idhidden" value="<?php echo $data['chitietsanpham']['IdSanPham']?>">
						<label><b>Tên sản phẩm</b></label>
						<input type="text" name="tenSp" id="tenSp" placeholder="Nhập tên sản phẩm" value="<?php echo $data['chitietsanpham']['TenSanPham']?>">
						<label><b>Mô tả</b></label>
						<input type="text" name="moTa" id="moTa" placeholder="Nhập mô tả" value="<?php echo $data['chitietsanpham']['MoTa']?>">
						<label><b>Giá</b></label>
						<input type="text" name="gia" id="gia" placeholder="Nhập giá (Ví dụ : 200000)" value="<?php echo $data['chitietsanpham']['Gia']?>">
						<label><b>Số lượng</b></label>
						<input type="number" name="soLuong" id="soLuong" placeholder="Nhập số lượng" value="<?php echo $data['chitietsanpham']['SoLuong']?>" min="1">
						<label><b>Giảm giá (%)</b></label>
						<input type="number" name="giamgia" id="giamgia" placeholder="Nhập số % muốn giảm" value="<?php echo $data['chitietsanpham']['GiamGia']?>" min="0" max="100">


						<label><b>Chọn kiểu size</b></label>
						<select name="chonkieusize" id="chonkieusize">
							<?php
								// lấy danh sách kieu size
							while($ks = mysqli_fetch_assoc($data['listkieusize'])){ ?>
								<option <?php if($data['chitietsanpham']['IdKieuSize'] == $ks['IdKieuSize']) echo "selected = 'selected'";?> value="<?=$ks['IdKieuSize']?>"><?=$ks['TenKieuSize']?>
								</option>
							<?php } ?>
						</select>
						<label><b>Chọn size</b></label>
						<div class="size-main" id="chonsize">
							<!-- lấy danh sách size -->
							<?php foreach ($data['listsize'] as $key => $value) { ?>
								<div class="chonsize">
									<!-- kiểm tra size dó có thuộc sản phẩm này ko -->
									<input <?php 
									while ($sizesp = mysqli_fetch_assoc($data['listsizesp'])) {
										if($sizesp['size_IdSize'] == $value['IdSize']){
											 echo "checked = 'checked'";
											 break;
										}
									}?> type="checkbox" name="size[]" value="<?=$value['IdSize']?>">
									<label>Size <?=$value['TenSize']?></label>
								</div>
							<?php }?>
						</div>
						<br>
						<div id="showthongbao"><?=$data['tbao'];?></div>
						<br>
						<div class="xuly">
							<button type="submit" name="updatesanpham">Cập nhật</button>
							<button type="reset" onclick="removeBackground()">Làm mới</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>

	<?php include('admin-footer.php');?>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./public/js/toggleMenu.js"></script>
<script src="./public/js/validate-form.js"></script>
<script type="text/javascript">
	//mặc định các icon label bị mờ đi
	var a = document.getElementsByClassName('label');
	// console.log(a);
	for(var i = 0 ; i < a.length ; i++){
		a[i].style.opacity = '0.2';
	}

	function onChange(id){
		var a = document.getElementById('hinhanh'+id).files[0];
		// console.log(a);
		var reader = new FileReader();
		// đã đọc xong
		reader.onloadend = function(){
			var src = document.getElementById("spam"+id);
			src.src = reader.result;
			// cho nó nổi lên để khi làm mới nó ẩn đi , thì khi chọn lại nó sẽ nổi lên
			src.style.opacity = '1';
			console.log(src.src);
		}

 		// nếu a tồn tại or đúng thì sẽ thực hiện đổ dữ liệu vào , ở đây là background img
 		if(a){
 			reader.readAsDataURL(a);
 		}else{

 		}

 		// ktra background-img của div có chưa , rồi thì làm mờ icon
 		var check = document.getElementById('hinhanh'+id);
 		if(check.src != ''){
 			document.getElementById('label'+id).style.opacity = '0.2';
 		}
 	}

 	//mặc định các ảnh được lấy ra sẵn để thực hiện cho việc remove background
 	var hinhanh1 = document.getElementById('spam1').src;
 	var hinhanh2 = document.getElementById('spam2').src;
 	var hinhanh3 = document.getElementById('spam3').src;
 	var hinhanh4 = document.getElementById('spam4').src;
 	var hinhanh5 = document.getElementById('spam5').src;
 	// lấy div chọn size
 	var a = document.getElementById('chonsize');
 	var b = a.innerHTML;

 	function removeBackground(){
 		var hinhanh11 = document.getElementById('spam1');
 		var hinhanh21 = document.getElementById('spam2');
 		var hinhanh31 = document.getElementById('spam3');
 		var hinhanh41 = document.getElementById('spam4');
 		var hinhanh51 = document.getElementById('spam5');
 		
 		hinhanh11.src = hinhanh1;
 		hinhanh21.src = hinhanh2;
 		hinhanh31.src = hinhanh3;
 		hinhanh41.src = hinhanh4;
 		hinhanh51.src = hinhanh5;

 		a.innerHTML = b;
	}
 </script>

 <!-- xử lý khi thay đổi chọn kiểu size -->
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#chonkieusize').change(function show(){
 			var idkieusize = $('#chonkieusize').val();
 			var idsanpham = $('#idhidden').val();
 			$.ajax({
 				type : 'GET',
 				url : "./AdminSanPhamController/loadsize/"+idkieusize+"/"+idsanpham,
 				data : idkieusize,
 				success : function(data){
 					// console.log(data);
 					$('#chonsize').html(data);
 				}
 			});
 			// console.log("./AdminSanPhamController/loadsize/"+idkieusize);
 		});
 	});
 </script>
 </html>