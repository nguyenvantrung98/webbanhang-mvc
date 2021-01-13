<!DOCTYPE html>
<html>
<head>
	<title>Thêm sản phẩm</title>
	
	<?php include('admin-header.php');?>

	<section class="main-admin">
		<?php include('admin-menu.php');?>

		<div id="content-admin">
			<h1>Sản phẩm / <span>Thêm mới</span></h1>
			<hr>
			<br>
			<form id="formSanPham" method="post" enctype="multipart/form-data" onsubmit="return validateForm(formSanPham)">
				<div class="content-main-themsp">
					<div class="img-themsp">
						<div class="img-main-themsp">
							<div title="Ảnh" class="themsp-img">
								<input type="file" name="file-main" id="hinhanh1" onchange="onChange(1)" accept="image/*" />
								<img id="spam1" class="img">
								<label for="hinhanh1" id="label1">
									<i class="fas fa-folder-plus"></i><b>Nhấp chọn ảnh</b>
								</label>
							</div>
						</div>
						<div class="imgs-phu-themsp">
							<div title="Ảnh 1" class="img-phu">
								<input type="file" name="img-phu2" id="hinhanh2" onchange="onChange(2)" accept="image/*" >
								<img id="spam2" class="img">
								<label for="hinhanh2" id="label2"><i class="fas fa-folder-plus"></i>Nhấp chọn ảnh</label>
							</div>
							<div title="Ảnh 2" class="img-phu">
								<input type="file" name="img-phu3" id="hinhanh3" onchange="onChange(3)" accept="image/*" >
								<img id="spam3" class="img">
								<label for="hinhanh3" id="label3"><i class="fas fa-folder-plus"></i>Nhấp chọn ảnh</label>
							</div>
							<div title="Ảnh 3" class="img-phu">
								<input type="file" name="img-phu4" id="hinhanh4" onchange="onChange(4)" accept="image/*" >
								<img id="spam4" class="img">
								<label for="hinhanh4" id="label4"><i class="fas fa-folder-plus"></i>Nhấp chọn ảnh</label>
							</div>
							<div title="Ảnh 4" class="img-phu">
								<input type="file" name="img-phu5" id="hinhanh5" onchange="onChange(5)" accept="image/*" >
								<img id="spam5" class="img">
								<label for="hinhanh5" id="label5"><i class="fas fa-folder-plus"></i>Nhấp chọn ảnh</label>
							</div>
						</div>
					</div>
					<div class="mota-themsp">
						<label><b>Tên thể loại</b></label>
						<!-- giả xử cho tên thể loại là áo sơ mi nữ -->
						<select name="tenTheLoai" id="tenTheLoai">
							<option value="">Chọn thể loại</option>
							<?php while($rs = mysqli_fetch_assoc($data['listtheloai'])){ ?>
									<option value="<?php echo $rs['IdTheLoai']?>"><?php echo $rs['TenTheLoai']?></option>
							<?php } ?>
						</select>
						<input type="hidden" name="idhidden" id="idhidden" value="trung">
						<label><b>Tên sản phẩm</b></label>
						<input type="text" name="tenSp" id="tenSp" placeholder="Nhập tên sản phẩm">
						<label><b>Mô tả</b></label>
						<input type="text" name="moTa" id="moTa" placeholder="Nhập mô tả">
						<label><b>Giá</b></label>
						<input type="text" name="gia" id="gia" placeholder="Nhập giá (Ví dụ : 200000)">
						<label><b>Số lượng</b></label>
						<input type="number" name="soLuong" id="soLuong" placeholder="Nhập số lượng">
						<label><b>Giảm giá (%)</b></label>
						<input type="number" name="giamgia" id="giamgia" placeholder="Nhập số % muốn giảm" min="0" max="100">
						<label><b>Chọn kiểu size</b></label>
						<select name="chonkieusize" id="chonkieusize">
							<option value="">Chọn kiểu size</option>
							<?php while($ks = mysqli_fetch_assoc($data['listkieusize'])){ ?>
								<option value="<?=$ks['IdKieuSize']?>"><?=$ks['TenKieuSize']?></option>
							<?php } ?>
						</select>
						<label id="label"><b>Chọn size</b></label>
						<!-- check id của chọn thể loại để hiển thị ra size tương ứng , sdung ajax khi onchange -->
						<!-- foreach -->
						<div class="size-main" id="chonsize">
							
						</div>
						<br>
						<div id="showthongbao"><?=$data['tbao'];?></div>
						<br>
						<div class="xuly">
							<button type="submit" name="addsanpham">Thêm mới</button>
							<button type="reset" onclick="removeBackground()">Làm mới</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>

	<?php include('admin-footer.php');?>
</body>
<script src="./public/js/toggleMenu.js"></script>
<script src="./public/js/validate-form.js"></script>
<script type="text/javascript">
	function onChange(id){
		var a = document.getElementById('hinhanh'+id).files[0];
		console.log(a);
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
 		reader.readAsDataURL(a);

 		// ktra background-img của div có chưa , rồi thì làm mờ icon
 		var check = document.getElementById('hinhanh'+id);
 		if(check.src != null){
 			document.getElementById('label'+id).style.opacity = '0.2';
 		}
 	}

 	function removeBackground(){
 		var c = document.getElementsByClassName('img');
 		var label = document.getElementById('label').style.display = 'none';
 		var chonsize = document.getElementById('chonsize').style.display = 'none';
 		for(var i = 0 ; i < c.length ; i++){
 			if(c[i].src == ''){
 				//rỗng thì ko cần xóa
 			}else{
 				c[i].removeAttribute('src');
 				c[i].style.opacity = '0';
 				document.getElementById('label'+[i+1]).style.opacity = '1';
 			}
 		}
 	}
 </script>

 <!-- xử lý khi thay đổi chọn kiểu size -->
 <script type="text/javascript">
 	$(document).ready(function(){
 		$('#label').hide();
 		$('#chonkieusize').change(function show(){
 			var idkieusize = $('#chonkieusize').val();
 			var idsanpham = $('#idhidden').val();
 			if(idkieusize == ""){
 				$('#label').hide();
 				$('#chonsize').hide();
 			}else{
 				$('#label').show();
 				$('#chonsize').show();
 				$.ajax({
 					type : 'GET',
 					url : "./AdminSanPhamController/loadsize/"+idkieusize+"/"+idsanpham,
 					data : idkieusize,
 					success : function(data){
 						// console.log(data);
 						$('#chonsize').html(data);
 					}
 				});
 			}
 		});
 	});
 </script>
 </html>