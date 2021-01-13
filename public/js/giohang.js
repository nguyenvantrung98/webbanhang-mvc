function formatNumber(num) {
	return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
}

//lấy số trên value xuống , sau đó xóa dấu chấm đi , rồi chuyển chuổi đó sang số
// nhân vs số lượng  , rồi chuyển số sang lại lại chuỗi + 'đ' , và format số đó thành chuỗi theo dạng tiền
// ví dụ(200000 => "200.000")

function tang(id){
	event.preventDefault();
	var soluong = document.getElementById('soLuong'+id);
	var check = document.getElementById('checkbox'+id).checked;
	// console.log(check);
	if(soluong.value >= 100){
		soluong.value = 100;
	}else{
		soluong.value = parseInt(soluong.value)+1; // đổi sl sang kiểu số
		var dongia = document.getElementById('dongia'+id).value;
		// console.log(dongia.value);
		var c = dongia.replace(/\./g,'');
		var c1 = parseInt(c);
		var kq = soluong.value*c1;
		var tongthanhtien = formatNumber(kq)+'đ';
		var thanhtien = document.getElementById('thanhtien'+id);
		thanhtien.value = tongthanhtien;
		if(check == true){
			var tongtien = document.getElementById('tongtien');
			var d = tongtien.value.replace(/\./g,'');
			var d1 = parseInt(d);
			var tong = d1 + c1;
			var tongtien1 = formatNumber(tong)+'đ';
			tongtien.value = tongtien1;
		}
		// var tongtien = document.getElementById('tongtien');
		// var d = tongtien.value.replace(/\./g,'');
		// var d1 = parseInt(d);
		// var tong = d1 + c1;
		// var tongtien1 = formatNumber(tong)+'đ';
		// if(check == true){
		// 	tongtien.value = tongtien1;
		// }else{

		// }
		
	}
}

function giam(id){
	event.preventDefault();
	var soluong = document.getElementById('soLuong'+id);
	var check = document.getElementById('checkbox'+id).checked;
	if(soluong.value <= 1){
		soluong.value = 1;
	}else{
		soluong.value = parseInt(soluong.value)-1; // đổi sl sang kiểu số
		var dongia = document.getElementById('dongia'+id).value;
		// console.log(dongia.value);
		var c = dongia.replace(/\./g,'');
		var c1 = parseInt(c);
		var kq = soluong.value*c1;
		var tongthanhtien = formatNumber(kq)+'đ';
		var thanhtien = document.getElementById('thanhtien'+id);
		thanhtien.value = tongthanhtien;
		if(check == true){
			var tongtien = document.getElementById('tongtien');
			var d = tongtien.value.replace(/\./g,'');
			var d1 = parseInt(d);
			var tong = d1 - c1;
			var tongtien1 = formatNumber(tong)+'đ';
			tongtien.value = tongtien1;
		}
		// var tongtien = document.getElementById('tongtien');
		// var d = tongtien.value.replace(/\./g,''); // tổng tiền hiện tại
		// var d1 = parseInt(d);
		// var tong = d1 - c1; // tiền hiện tại trừ đơn giá khi click
		// var tongtien1 = formatNumber(tong)+'đ';
		// tongtien.value = tongtien1;
	}
}

function checkbox(id){
	var check = document.getElementById('checkbox'+id).checked;
	var tongtien = document.getElementById('tongtien');
	if(check == true){
		var thanhtien = document.getElementById('thanhtien'+id).value;
		var d1 = thanhtien.replace(/\./g,''); // tổng tiền hiện tại
		var d11 = parseInt(d1);
		// var tong1 = d11 + thanhtien;
		// alert(thanhtien);
		var d = tongtien.value.replace(/\./g,''); // tổng tiền hiện tại
		var d1 = parseInt(d);
		var tong = d1 + d11; // tiền hiện tại trừ đơn giá khi click
		var tongtien1 = formatNumber(tong)+'đ';
		tongtien.value = tongtien1;
	}else{
		var thanhtien = document.getElementById('thanhtien'+id).value;
		var d1 = thanhtien.replace(/\./g,''); // tổng tiền hiện tại
		var d11 = parseInt(d1);
		// var tong1 = d11 + thanhtien;
		// alert(thanhtien);
		var d = tongtien.value.replace(/\./g,''); // tổng tiền hiện tại
		var d1 = parseInt(d);
		var tong = d1 - d11; // tiền hiện tại trừ đơn giá khi click
		var tongtien1 = formatNumber(tong)+'đ';
		tongtien.value = tongtien1;
	}
}
