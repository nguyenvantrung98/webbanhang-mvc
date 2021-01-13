<div id="menu1">
	<ul style="border: 1px solid #e7e7e7">
		<li><a onclick="toggle(0)" href="#"><i class="fas fa-home"></i>Trang chủ</a>
			<ul id="0" class="menu-con">
				<li>
					<a href="./AdmimHomeController/home"><i class="fas fa-list"></i>Thống kê</a>
				</li>
			</ul>
		</li>
		<li>
			<a onclick="toggle(1)" href="#"><i class="fas fa-address-book"></i>Danh mục</a>
			<ul id="1" class="menu-con">
				<li>
					<a href="./AdminDanhMucController/danhmuc/danhsach"><i class="fas fa-list"></i>Danh sách danh mục</a>
				</li>
				<li>
					<a href="./AdminDanhMucController/themdanhmuc"><i class="fas fa-folder-plus"></i>Thêm danh mục</a>
				</li>
			</ul>
		</li>
		<li><a onclick="toggle(2)" href="#"><i class="fas fa-bars"></i>Thể loại</a>
			<ul id="2" class="menu-con">
				<li>
					<a href="./AdminTheLoaiController/theloai/danhsach"><i class="fas fa-list"></i>Danh sách thể loại</a>
				</li>
				<li>
					<a href="./AdminTheLoaiController/themtheloai"><i class="fas fa-folder-plus"></i>Thêm thể loại</a>
				</li>
			</ul>
		</li>
		<li><a onclick="toggle(3)" href="#"><i class="fab fa-product-hunt"></i>Sản phẩm</a>
			<ul id="3" class="menu-con">
				<li>
					<li>
						<a href="./AdminSanPhamController/sanpham/danhsach"><i class="fas fa-list"></i>Danh sách sản phẩm</a>
					</li>
					<li>
						<a href="./AdminSanPhamController/sanpham/danhsachsale"><i class="fas fa-list"></i>Sản phẩm sale</a>
					</li>
					<li>
						<a href="./AdminSanPhamController/themsanpham"><i class="fas fa-folder-plus"></i>Thêm sản phẩm</a>
					</li>
				</li>
			</ul>
		</li>
		<li><a onclick="toggle(4)" href="#"><i class="fas fa-sliders-h"></i>Kiểu Size</a>
			<ul id="4" class="menu-con">
				<li>
					<a href="./AdminKieuSizeController/kieusize/danhsach"><i class="fas fa-list"></i>Danh sách kiểu size</a>
				</li>
				<li>
					<a href="./AdminKieuSizeController/themkieusize"><i class="fas fa-folder-plus"></i>Thêm kiểu size</a>
				</li>
				<li>
					<a href="./AdminKieuSizeController/size/danhsach"><i class="fas fa-list"></i>Danh sách size</a>
				</li>
				<li>
					<a href="./AdminKieuSizeController/themsize"><i class="fas fa-folder-plus"></i>Thêm size</a>
				</li>
			</ul>
		</li>
		<li><a onclick="toggle(5)" href="#"><i class="fas fa-sliders-h"></i>Slide</a>
			<ul id="5" class="menu-con">
				<li>
					<a href="./AdminSlideController/slide/danhsach"><i class="fas fa-list"></i>Danh sách slide</a>
				</li>
				<li>
					<a href="./AdminSlideController/themslide"><i class="fas fa-folder-plus"></i>Thêm slide</a>
				</li>
			</ul>
		</li>
		<li><a onclick="toggle(6)" href="#"><i class="fas fa-users"></i>Tài khoản</a>
			<ul id="6" class="menu-con">
				<li>
					<a href="./AdminTaiKhoanController/taikhoan/danhsach/list"><i class="fas fa-list"></i>Danh sách tài khoản</a>
				</li>
				<li>
					<a href="./AdminTaiKhoanController/taikhoan/nguoidung/list"><i class="fas fa-list"></i>Danh sách người dùng</a>
				</li>
				<li>
					<a href="./AdminTaiKhoanController/taikhoan/quantri/list"><i class="fas fa-list"></i>Danh sách quản trị</a>
				</li>
				<li>
					<a href="./AdminTaiKhoanController/themtaikhoan/add"><i class="fas fa-folder-plus"></i>Thêm tài khoản</a>
				</li>
				<li>
					<a href="./AdminTaiKhoanController/taikhoan/chuakichhoat/list"><i class="fas fa-list"></i>Danh sách chưa kích hoạt</a>
				</li>
				<li>
					<a href="./AdminTaiKhoanController/taikhoan/dangkhoa/list"><i class="fas fa-list"></i>Danh sách đã khóa</a>
				</li>
				<li>
					<a href="./AdminTaiKhoanController/taikhoan/daxoa/list"><i class="fas fa-list"></i>Danh sách đã xóa</a>
				</li>
			</ul>
		</li>
		<li><a onclick="toggle(7)" href="#"><i class="fas fa-newspaper"></i>Đơn hàng</a>
			<ul id="7" class="menu-con">
				<li>
					<a href="./AdminDonHangController/donhang/news"><i class="fas fa-list"></i>Danh sách đơn hàng</a>
				</li>
				<li>
					<a href="./AdminDonHangController/donhang/dachot"><i class="fas fa-list"></i>Đơn hàng đang giao</a>
				</li>
				<li>
					<a href="./AdminDonHangController/donhang/chuachot"><i class="fas fa-list"></i>Đơn hàng đang chờ</a>
				</li>
				<li>
					<a href="./AdminDonHangController/donhang/dagiao"><i class="fas fa-list"></i>Đơn hàng đã giao</a>
				</li>
				<li>
					<a href="./AdminDonHangController/donhang/dahuy"><i class="fas fa-list"></i>Đơn hàng đã hủy</a>
				</li>
			</ul>
		</li>
		<li><a onclick="toggle(8)" href="#"><i class="fas fa-comment-alt"></i>Bình luận</a>
			<ul id="8" class="menu-con">
				<li>
					<a href="./AdminBinhLuanController/binhluan/danhsach"><i class="fas fa-list"></i>Danh sách bình luận</a>
				</li>
			</ul>
		</li>
		<li><a href="#" onclick="toggle(9)"><i class="fas fa-comments"></i>Góp ý & Phản hồi</a>
			<ul id="9" class="menu-con">
				<li>
					<a href="./AdminGopYController/gopy/danhsach"><i class="fas fa-list"></i>Danh sách phản hồi</a>
				</li>
			</ul>
		</li>
		<li><a href="#" onclick="toggle(10)"><i class="fas fa-cog"></i>Cài đặt</a>
			<ul id="10" class="menu-con">
				<li>
					<a href="#"><i class="fas fa-upload"></i>Import Data</a>
				</li>
				<li>
					<a href="#"><i class="fas fa-download"></i>Export Data</a>
				</li>
			</ul>
		</li>
	</ul>
</div>