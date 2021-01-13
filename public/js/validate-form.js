function xoa_dau(str) {
	str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
	str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
	str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
	str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
	str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
	str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
	str = str.replace(/đ/g, "d");
	str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
	str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
	str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
	str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
	str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
	str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
	str = str.replace(/Đ/g, "D");
	return str;
}

function xoa_khoang_trang(str){
	str = str.replace(/\s+/g,' ');
}

function validateForm(name){
	var tbao = document.getElementById('showthongbao');
	// var tbao2 = document.getElementById('showthongbao2');
	var tbaoGopy = document.getElementById('showthongbao1');
	var so = /^(?=.*[a-z])(?=.*[0-9])[a-zA-Z0-9!@#$%^&*()]{8,32}$/; //ktra mk có số chưa
	var inhoa = /^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*()]{8,32}$/;//ktra chữ cái in hoa
	// ktra kí tự đặc biệt đã có chưa
	var chu = /^(?=.*[a-z])[a-zA-Z0-9!@#$%^&*()]{8,32}$/;
	var kitudacbiet = /^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()])[a-zA-Z0-9!@#$%^&*()]{8,32}$/;
	var ktrmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{3,4})+$/;//check email
	var checkHoTen =/^[a-zA-Z/\s]+[^@!#$%^&*()_+-=0-9]+$/; // chỉ đc nhập chữ và dấu cách
	var checkSĐT = /^\+?(?:0|84)[0-9]{9}$/; // chỉ được là số , và có 10 kí tự , 0 | 84 | +84
	var checkDiaChi = /^[a-zA-Z/\s,0-9]+[^@!#$%^&*()_+-=]+$/; // địa chỉ chỉ đc chứa số , kí tự , / và ,
	var checkMaXacNhan = /^[0-9]{6}$/;

	// check form đăng nhập
	if(name['id'] == 'formDangNhap'){
		var tendangnhap = document.getElementById('tenDangNhap').value.trim();
		var matkhau = document.getElementById('matKhau').value.trim();
		if(tendangnhap == '' && matkhau == '')
		{
			tbao.innerHTML = 'Vui lòng nhập đầy đủ thông tin';
			return false;
		}else if(tendangnhap != '' && matkhau == ''){
			tbao.innerHTML = 'Mật khẩu không được để trống';
			return false;
		}else if(tendangnhap == '' && matkhau != ''){
			tbao.innerHTML = 'Tên đăng nhập không được để trống';
			return false;
		}else if(tendangnhap.length > 42){
			tbao.innerHTML = 'Tên đăng nhập không được >42 kí tự';
			return false;
		}else if(tendangnhap.length <= 10){
			tbao.innerHTML = 'Tên đăng nhập phải >10 kí tự';
			return false;
		}else if(!ktrmail.test(tendangnhap)){
			tbao.innerHTML = 'Email không đúng định dạng';
			return false;
		}else if(matkhau.length < 8){
			tbao.innerHTML = 'Mật khẩu phải >= 8 kí tự';
			return false;
		}else if(matkhau.length > 32){
			tbao.innerHTML = 'Mật khẩu phải < 32 kí tự';
			return false;
		}else if(!so.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ số';
			return false;
		}else if(!inhoa.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ in hoa';
			return false;
		}else if(!kitudacbiet.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 kí tự đặc biệt';
			return false;
		}
		// else if(!checkMatKhau.test(matkhau)){
		// 	tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 kí tự đặc biệt !@#$%^&*() , 1 chữ số và 1 chữ in hoa';
		// 	return false;
		// }
		else
			return true;
	}

	// check form đăng ký
	else if(name['id'] == 'formDangKy'){
		var tendangnhap = document.getElementById('tenDangNhap').value.trim();
		var matkhau = document.getElementById('matKhau').value.trim();
		var hoten = document.getElementById('hoTen').value.trim();
		var sdt = document.getElementById('sdt').value.trim();
		var diachi = document.getElementById('diaChi').value.trim();
		var nlmk = document.getElementById('nhapLaiMatKhau').value.trim();
		var xoadauHoTen = xoa_dau(hoten);
		var xoadauDiaChi = xoa_dau(diachi);

		if(hoten == '' && sdt== '' && diachi == '' && tendangnhap == '' && matkhau == '' && nlmk ==''){
			tbao.innerHTML = 'Vui lòng nhập đầy đủ thông tin';
			return false;
		}else if(hoten == ''){
			tbao.innerHTML = 'Họ tên không được để trống';
			return false;
		}else if(hoten.length <= 8 || hoten.length > 42){
			tbao.innerHTML = 'Họ tên phải >8 và <42 kí tự';
			return false;
		}else if(!checkHoTen.test(xoadauHoTen)){
			tbao.innerHTML = 'Họ tên không được chứa kí tự đặc biệt và chữ số';
			return false;
		}else if(sdt == ''){
			tbao.innerHTML = 'Số điện thoại không được để trống';
			return false;
		}else if(!checkSĐT.test(sdt)){
			tbao.innerHTML = 'Số điện thoại của bạn không đúng , vui lòng kiểm tra lại';
			return false;
		}else if(diachi == ''){
			tbao.innerHTML = 'Địa chỉ không được để trống';
			return false;
		}else if(diachi.length < 8){
			tbao.innerHTML = 'Địa chỉ quá ngắn';
			return false;
		}else if(!checkDiaChi.test(xoadauDiaChi)){
			tbao.innerHTML = 'Địa chỉ không được chứa kí tự đặc biệt';
			return false;
		}else if(tendangnhap == ''){
			tbao.innerHTML = 'Tên đăng nhập không được để trống';
			return false;
		}else if(tendangnhap.length > 42){
			tbao.innerHTML = 'Tên đăng nhập không được >42 kí tự';
			return false;
		}else if(tendangnhap.length <= 10){
			tbao.innerHTML = 'Tên đăng nhập phải >10 kí tự';
			return false;
		}else if(!ktrmail.test(tendangnhap)){
			tbao.innerHTML = 'Email không đúng định dạng';
			return false;
		}else if(matkhau == ''){
			tbao.innerHTML = 'Mật khẩu không được để trống';
			return false;
		}else if(matkhau.length < 8){
			tbao.innerHTML = 'Mật khẩu phải >= 8 kí tự';
			return false;
		}else if(matkhau.length > 32){
			tbao.innerHTML = 'Mật khẩu phải < 32 kí tự';
			return false;
		}else if(!chu.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có chữ cái thường';
			return false;
		}else if(!so.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ số';
			return false;
		}else if(!inhoa.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ in hoa';
			return false;
		}else if(!kitudacbiet.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 kí tự đặc biệt';
			return false;
		}else if(nlmk == ''){
			tbao.innerHTML = 'Bạn cần xác nhận lại mật khẩu';
			return false;
		}else if(matkhau != nlmk){
			tbao.innerHTML = 'Mật khẩu nhập lại không khớp , vui lòng kiểm tra lại';
			return false;
		}else
		return true;
	}

	// check form thông tin cá nhân
	else if(name['id'] == 'formThongTinCaNhan'){
		var hoten = document.getElementById('hoten').value.trim();
		var sdt = document.getElementById('SDT').value.trim();
		var diachi = document.getElementById('diaChi').value.trim();
		var gioitinh = document.querySelector("[name='gender']:checked");
		var ngaysinh = document.getElementById('ngaySinh');
		var xoaDauHoTen = xoa_dau(hoten);
		var xoaDauDiaChi = xoa_dau(diachi);
		var checkDMK = document.getElementById('dmk');
		// console.log(checkDMK.checked);
		if(hoten == ''){
			tbao.innerHTML = 'Họ tên không được để trống';
			return false;
		}else if(diachi == ''){
			tbao.innerHTML = 'Địa chỉ không được để trống';
			return false;
		}else if(sdt == ''){
			tbao.innerHTML = 'Số điện thoại không được để trống';
			return false;
		}else if(hoten == ''){
			tbao.innerHTML = 'Họ tên không được để trống';
			return false;
		}else if(hoten.length <= 8 || hoten.length > 42){
			tbao.innerHTML = 'Họ tên phải >8 và <42 kí tự';
			return false;
		}else if(!checkHoTen.test(xoaDauHoTen)){
			tbao.innerHTML = 'Họ tên không được chứa kí tự đặc biệt và chữ số';
			return false;
		}else if(sdt == ''){
			tbao.innerHTML = 'Số điện thoại không được để trống';
			return false;
		}else if(!checkSĐT.test(sdt)){
			tbao.innerHTML = 'Số điện thoại của bạn không đúng , vui lòng kiểm tra lại';
			return false;
		}else if(diachi == ''){
			tbao.innerHTML = 'Địa chỉ không được để trống';
			return false;
		}else if(diachi.length < 8){
			tbao.innerHTML = 'Địa chỉ quá ngắn';
			return false;
		}else if(!checkDiaChi.test(xoaDauDiaChi)){
			tbao.innerHTML = 'Địa chỉ không được chứa kí tự đặc biệt';
			return false;
		}else if(checkDMK.checked == true){
			var mkhientai = document.getElementById('mkhientai').value.trim();
			var mkmoi = document.getElementById('mkmoi').value.trim();
			var nlmkmoi = document.getElementById('nlmkmoi').value.trim();

			if(mkhientai == ''){
				tbao.innerHTML = 'Mật khẩu hiện tại không được để trống';
				return false;
			}else if(mkmoi == ''){
				tbao.innerHTML = 'Mật khẩu mới không được để trống';
				return false;
			}else if(nlmkmoi == ''){
				tbao.innerHTML = 'Bạn chưa xác nhận lại mật khẩu mới';
				return false;
			}else if(mkmoi.length < 8){
				tbao.innerHTML = 'Mật khẩu phải có ít nhất 8 kí tự';
				return false;
			}else if(mkmoi.length > 32){
				tbao.innerHTML = 'Mật khẩu phải ngắn hơn 32 kí tự';
				return false;
			}else if(!chu.test(mkmoi)){
				tbao.innerHTML = 'Mật khẩu phải có chữ cái thường';
				return false;
			}else if(!so.test(mkmoi)){
				tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ số';
				return false;
			}else if(!inhoa.test(mkmoi)){
				tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ in hoa';
				return false;
			}else if(!kitudacbiet.test(mkmoi)){
				tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 kí tự đặc biệt';
				return false;
			}else if(nlmkmoi != mkmoi){
				tbao.innerHTML = 'Mật khẩu nhập lại không khớp , vui lòng kiểm tra lại';
				return false;
			}else if(mkmoi == mkhientai){
				tbao.innerHTML = 'Mật khẩu mới không được trùng với mật khẩu cũ';
				return false;
			}
		}else
			return true;
	}

	// check form đổi mật khẩu
	else if(name['id'] == 'formDoiMatKhau'){
		var mkhientai = document.getElementById('mkhientai').value.trim();
		var mkmoi = document.getElementById('mkmoi').value.trim();
		var nlmkmoi = document.getElementById('nlmkmoi').value.trim();

		if(mkhientai == '' && mkmoi == '' && nlmkmoi == ''){
			tbao.innerHTML = 'Vui lòng nhập đầy đủ thông tin';
			return false;
		}else if(mkhientai == ''){
			tbao.innerHTML = 'Mật khẩu hiện tại không được để trống';
			return false;
		}else if(mkmoi == ''){
			tbao.innerHTML = 'Mật khẩu mới không được để trống';
			return false;
		}else if(nlmkmoi == ''){
			tbao.innerHTML = 'Bạn chưa xác nhận lại mật khẩu mới';
			return false;
		}else if(mkmoi.length < 8){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 8 kí tự';
			return false;
		}else if(mkmoi.length > 32){
			tbao.innerHTML = 'Mật khẩu phải ngắn hơn 32 kí tự';
			return false;
		}else if(!chu.test(mkmoi)){
			tbao.innerHTML = 'Mật khẩu phải có chữ cái thường';
			return false;
		}else if(!so.test(mkmoi)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ số';
			return false;
		}else if(!inhoa.test(mkmoi)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ in hoa';
			return false;
		}else if(!kitudacbiet.test(mkmoi)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 kí tự đặc biệt';
			return false;
		}else if(nlmkmoi != mkmoi){
			tbao.innerHTML = 'Mật khẩu nhập lại không khớp , vui lòng kiểm tra lại';
			return false;
		}else if(mkmoi == mkhientai){
			tbao.innerHTML = 'Mật khẩu mới không được trùng với mật khẩu cũ';
			return false;
		}
		else
			return true;
	}

	// check form góp ý
	else if(name['id'] == 'formGopY'){
		var hoten = document.getElementById('hoTen').value.trim();
		var sdt = document.getElementById('sdt').value.trim();
		var email = document.getElementById('email').value.trim();
		var noidung = document.getElementById('noiDung').value.trim();
		var xoaDauHoTen = xoa_dau(hoten);
		if(hoten == '' && sdt == '' && email == '' && noidung == ''){
			tbaoGopy.innerHTML = 'Vui lòng nhập đầy đủ thông tin';
			return false;
		}else if(hoten == ''){
			tbaoGopy.innerHTML = 'Họ tên không được để trống';
			return false;
		}else if(sdt == ''){
			tbaoGopy.innerHTML = 'Số điện thoại không được để trống';
			return false;
		}else if(email == ''){
			tbaoGopy.innerHTML = 'Email không được để trống';
			return false;
		}else if(noidung == ''){
			tbaoGopy.innerHTML = 'Nội dung không được để trống';
			return false;
		}else if(hoten.length <= 8 || hoten.length > 42){
			tbaoGopy.innerHTML = 'Họ tên phải >8 và <42 kí tự';
			return false;
		}else if(!checkHoTen.test(xoaDauHoTen)){
			tbaoGopy.innerHTML = 'Họ tên không được chứa kí tự đặc biệt và chữ số';
			return false;
		}else if(!checkSĐT.test(sdt)){
			tbaoGopy.innerHTML = 'Số điện thoại của bạn không đúng , vui lòng kiểm tra lại';
			return false;
		}else if(email.length > 42){
			tbaoGopy.innerHTML = 'Email không được >42 kí tự';
			return false;
		}else if(email.length <= 10){
			tbaoGopy.innerHTML = 'Email phải >10 kí tự';
			return false;
		}else if(!ktrmail.test(email)){
			tbaoGopy.innerHTML = 'Email không đúng định dạng';
			return false;
		}
		return true;
	}

	// chek form quên mật khẩu
	else if(name['id'] == 'formQuenMatKhau'){
		var email = document.getElementById('quenmatkhau').value.trim();
		if(email == ''){
			tbao.innerHTML = 'Email không được để trống';
			return false;
		}else if(email.length > 42){
			tbao.innerHTML = 'Email không được >42 kí tự';
			return false;
		}else if(email.length <= 10){
			tbao.innerHTML = 'Email phải >10 kí tự';
			return false;
		}else if(!ktrmail.test(email)){
			tbao.innerHTML = 'Email không đúng định dạng';
			return false;
		}else
		return true;
		// else{
		// 	document.getElementById('divthongbao').style.display = 'block';
		// 	document.getElementById('ok').click = function(){
		// 		return true;
		// 	}
		// 	return false;
		// }
	}

	// check formMaXacNhan
	else if(name['id'] == 'formMaXacNhan'){
		var maxacnhan = document.getElementById('quenmatkhau1').value.trim();
		if(maxacnhan == ''){
			tbao.innerHTML = 'Vui lòng nhập mã xác nhận';
			return false;
		}else if(!checkMaXacNhan.test(maxacnhan)){
			tbao.innerHTML = 'Mã xác nhận không đúng , vui lòng kiểm tra lại';
			return false;
		}
		return true;
	}

	// check form đặt lại mật khẩu
	else if(name['id'] == 'formDatLaiMatKhau'){
		var mkmoi = document.getElementById('mkmoi').value.trim();
		var nlmkmoi = document.getElementById('nlmkmoi').value.trim();
		if(mkmoi == '' && nlmkmoi == ''){
			tbao.innerHTML = 'Vui lòng nhập đầy đủ thông tin';
			return false;
		}else if(mkmoi == ''){
			tbao.innerHTML = 'Mật khẩu không được để trống';
			return false;
		}else if(nlmkmoi == ''){
			tbao.innerHTML = 'Nhập lại mật khẩu không được để trống';
			return false;
		}else if(mkmoi.length < 8){
			tbao.innerHTML = 'Mật khẩu phải >= 8 kí tự';
			return false;
		}else if(mkmoi.length > 32){
			tbao.innerHTML = 'Mật khẩu phải < 32 kí tự';
			return false;
		}else if(!chu.test(mkmoi)){
			tbao.innerHTML = 'Mật khẩu phải có chữ cái thường';
			return false;
		}else if(!so.test(mkmoi)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ số';
			return false;
		}else if(!inhoa.test(mkmoi)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ in hoa';
			return false;
		}else if(!kitudacbiet.test(mkmoi)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 kí tự đặc biệt';
			return false;
		}else if(nlmkmoi == ''){
			tbao.innerHTML = 'Bạn cần xác nhận lại mật khẩu';
			return false;
		}else if(mkmoi != nlmkmoi){
			tbao.innerHTML = 'Mật khẩu nhập lại không khớp , vui lòng kiểm tra lại';
			return false;
		}else
		return true;
	}

	// check form danh mục
	else if(name['id'] == 'themDanhMuc2'){
		var tendanhmuc = document.getElementById('tendanhmuc').value.trim();
		var xoaDauTenDanhMuc = xoa_dau(tendanhmuc);
		var checkTenDanhMuc = /^[a-zA-Z\s]+$/;
		if(!checkTenDanhMuc.test(xoaDauTenDanhMuc)){
			tbao.innerHTML = 'Tên danh mục không được chứa kí tự đặc biệt hoặc số';
			return false;
		}else if(tendanhmuc.length < 3){
			tbao.innerHTML = 'Tên danh mục phải > 3 kí tự';
			return false;
		}else if(tendanhmuc.length > 32){
			tbao.innerHTML = 'Tên danh mục phải < 32 kí tự';
			return false;
		}else
			return true;
	}

	// check form sửa thể loại
	else if(name['id'] == 'formtheloai'){
		var tentheloai = document.getElementById('tenTheLoai').value.trim();
		var xoaDauTenTheLoai = xoa_dau(tentheloai);
		var checkTenTheLoai = /^[a-zA-Z0-9\s]+$/;
		var anhdaidien = document.getElementById('img1').src; // gét theo src vì đã xử lý hình ảnh rồi
		// console.log(anhdaidien);
		var chondanhmuc = document.getElementById('chondanhmuc').value;
		if(tentheloai == ''){
			tbao.innerHTML = 'Tên thể loại không được để trống';
			return false;
		}else if(anhdaidien == ''){
			tbao.innerHTML = 'Vui lòng chọn 1 ảnh đại diện';
			return false;
		}else if(chondanhmuc == ''){
			tbao.innerHTML = 'Vui lòng chọn danh mục';
			return false;
		}
		else if(!checkTenTheLoai.test(xoaDauTenTheLoai)){
			tbao.innerHTML = 'Tên thể loại chỉ được chứa chữ và số';
			return false;
		}else
		return true;
	}

	// check form tài khoản
	else if(name['id'] == 'formtaikhoan'){
		var tendangnhap = document.getElementById('tenDangNhap').value.trim();
		var matkhau = document.getElementById('matKhau').value.trim();
		var hoten = document.getElementById('hoTen').value.trim();
		var sdt = document.getElementById('sdt').value.trim();
		var diachi = document.getElementById('diaChi').value.trim();
		var vaitro = document.getElementById('vaitro').value;
		var anhdaidien = document.getElementById('img1').src;
		var xoadauHoTen = xoa_dau(hoten);
		var xoadauDiaChi = xoa_dau(diachi);

		if(hoten == '' && sdt == '' && diachi == '' && tendangnhap == '' && matkhau == ''
			&& vaitro == '' && anhdaidien == ''){
			tbao.innerHTML = 'Vui lòng nhập đầy đủ thông tin';
			return false;
		}else if(hoten == ''){
			tbao.innerHTML = 'Họ tên không được để trống';
			return false;
		}else if(hoten.length <= 8 || hoten.length > 42){
			tbao.innerHTML = 'Họ tên phải >8 và <42 kí tự';
			return false;
		}else if(!checkHoTen.test(xoadauHoTen)){
			tbao.innerHTML = 'Họ tên không được chứa kí tự đặc biệt và chữ số';
			return false;
		}else if(sdt == ''){
			tbao.innerHTML = 'Số điện thoại không được để trống';
			return false;
		}else if(!checkSĐT.test(sdt)){
			tbao.innerHTML = 'Số điện thoại của bạn không đúng , vui lòng kiểm tra lại';
			return false;
		}else if(diachi == ''){
			tbao.innerHTML = 'Địa chỉ không được để trống';
			return false;
		}else if(diachi.length < 8){
			tbao.innerHTML = 'Địa chỉ quá ngắn';
			return false;
		}else if(!checkDiaChi.test(xoadauDiaChi)){
			tbao.innerHTML = 'Địa chỉ không được chứa kí tự đặc biệt';
			return false;
		}else if(tendangnhap == ''){
			tbao.innerHTML = 'Tên đăng nhập không được để trống';
			return false;
		}else if(tendangnhap.length > 42){
			tbao.innerHTML = 'Tên đăng nhập không được >42 kí tự';
			return false;
		}else if(tendangnhap.length <= 10){
			tbao.innerHTML = 'Tên đăng nhập phải >10 kí tự';
			return false;
		}else if(!ktrmail.test(tendangnhap)){
			tbao.innerHTML = 'Email không đúng định dạng';
			return false;
		}else if(matkhau == ''){
			tbao.innerHTML = 'Mật khẩu không được để trống';
			return false;
		}else if(matkhau.length < 8){
			tbao.innerHTML = 'Mật khẩu phải >= 8 kí tự';
			return false;
		}else if(matkhau.length > 32){
			tbao.innerHTML = 'Mật khẩu phải < 32 kí tự';
			return false;
		}else if(!chu.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có chữ cái thường';
			return false;
		}else if(!so.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ số';
			return false;
		}else if(!inhoa.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 chữ in hoa';
			return false;
		}else if(!kitudacbiet.test(matkhau)){
			tbao.innerHTML = 'Mật khẩu phải có ít nhất 1 kí tự đặc biệt';
			return false;
		}else if(vaitro == ''){
			tbao.innerHTML = 'Vui lòng chọn vai trò cho tài khoản';
			return false;
		}else if(anhdaidien == ''){
			tbao.innerHTML = 'Bạn chưa chọn ảnh đại diện';
			return false;
		}
	}

	// check form slide
	else if(name['id'] == 'formSlide'){
		var tenSlide = document.getElementById('tenSlide').value.trim();
		var anhSlide = document.getElementById('img1').src;
		var xoaDauTenSlide = xoa_dau(tenSlide);
		var checkTenSlide = /^[a-zA-Z0-9\s-/]+$/;

		if(tenSlide == '' && anhSlide == ''){
			tbao.innerHTML = 'Vui lòng nhập đầy đủ thông tin';
			return false;
		}else if(tenSlide == ''){
			tbao.innerHTML = 'Tên slide không được để trống';
			return false;
		}else if(anhSlide == ''){
			tbao.innerHTML = 'Bạn chưa chọn ảnh';
			return false;
		}else if(!checkTenSlide.test(xoaDauTenSlide)){
			tbao.innerHTML = 'Tên slide không được chứa kí tự đặc biệt';
			return false;
		}else
			return true;
	}

	// check form sản phẩm
	else if(name['id'] == 'formSanPham'){
		var tenSanPham = document.getElementById('tenSp').value.trim();
		var moTa = document.getElementById('moTa').value.trim();
		var gia = document.getElementById('gia').value.trim();
		var soLuong = document.getElementById('soLuong').value.trim();
		var size = document.querySelector("[name='size']:checked");
		var tenTheLoai = document.getElementById('tenTheLoai').value;
		var chonkieusize = document.getElementById('chonkieusize').value;
		// console.log(size);
		var xoaDauTenSanPham = xoa_dau(tenSanPham);
		var xoaDauMoTa = xoa_dau(moTa);
		var hinhanh = document.getElementsByClassName('img');
		// console.log(hinhanh);
		var checkTenSanPham = /^[a-zA-Z0-9\s]+$/;
		var checkGia = /^[0-9.]+$/;
		var checkSoLuong = /^[0-9]+$/;
		// ktra ảnh
		for(var i = 0 ; i < hinhanh.length ; i++){
			if(hinhanh[i].src == ''){
				tbao.innerHTML = 'Bạn phải chọn đủ ảnh';
				return false;
				// break;
			}
		}
		if(tenSanPham == '' && moTa == '' && gia == '' && soLuong == '' && size == null && tenTheLoai == '' && chonkieusize == ''){
			tbao.innerHTML = 'Vui lòng nhập đầy đủ thông tin';
			return false;
		}else if(tenTheLoai == ''){
			tbao.innerHTML = 'Bạn chưa chọn thể loại';
			return false;
		}else if(tenSanPham == ''){
			tbao.innerHTML = 'Tên sản phẩm không được để trống';
			return false;
		}else if(!checkTenSanPham.test(xoaDauTenSanPham)){
			tbao.innerHTML = 'Tên sản phẩm không được chứa kí tự đặc biệt';
			return false;
		}else if(tenSanPham.length < 3 || tenSanPham.length > 100){
			tbao.innerHTML = 'Tên sản phẩm phải lớn hơn 3 kí tự và ít hơn 100 kí tự';
			return false;
		}else if(moTa == ''){
			tbao.innerHTML = 'Tên mô tả không được để trống';
			return false;
		}else if(!checkTenSanPham.test(xoaDauMoTa)){
			tbao.innerHTML = 'Tên mô tả không được chứa kí tự đặc biệt';
			return false;
		}else if(moTa.length < 3 || moTa.length > 100){
			tbao.innerHTML = 'Tên mô tả phải lớn hơn 3 kí tự và ít hơn 100 kí tự';
			return false;
		}else if(gia == ''){
			tbao.innerHTML = 'Giá không được để trống';
			return false;
		}else if(!checkGia.test(gia)){
			tbao.innerHTML = 'Giá không được nhập chữ và kí tự đặc biệt';
			return false;
		}else if(gia < 0){
			tbao.innerHTML = 'Giá phải lớn hơn 0';
			return false;
		}else if(soLuong == ''){
			tbao.innerHTML = 'Số lượng không được để trống';
			return false;
		}else if(!checkSoLuong.test(soLuong)){
			tbao.innerHTML = 'Số lượng không được chứa chữ và kí tự đặc biệt';
			return false;
		}else if(soLuong < 1){
			tbao.innerHTML = 'Số lượng phải lớn hơn 0';
			return false;
		}else if(chonkieusize == ''){
			tbao.innerHTML = "Bạn chưa chọn kiểu size";
			return false;
		}
	}

	// check form Chi tiết sản phẩm client
	else if(name['id'] == 'formChiTietSanPham'){
		var chonSize = document.getElementById('chonSize').value;
		var soLuong = document.getElementById('soLuong').value;
		if(chonSize == ''){
			tbao.innerHTML = 'Bạn chưa chọn size';
			return false;
		}else if(soLuong < 1){
			tbao.innerHTML = 'Số lượng phải lớn hơn 0';
			return false;
		}else
			return true;
	}

	// check form size
	else if(name['id'] == 'formsize'){
		var chonkieusize = document.getElementById('chonkieusize').value;
		var tensize = document.getElementById('tensize').value.trim();
		var xoadautensize = xoa_dau(tensize);
		var checkTenSize = /^[a-zA-Z0-9\s]+$/;
		if(chonkieusize == ''){
			tbao.innerHTML = 'Bạn chưa chọn kiểu size';
			return false;
		}else if(tensize == ''){
			tbao.innerHTML = 'Tên size không được để trống';
			return false;
		}else if(!checkTenSize.test(xoadautensize)){
			tbao.innerHTML = 'Tên size không được chứa kí tự đặc biệt';
			return false;
		}else
			return true;
	}
}



