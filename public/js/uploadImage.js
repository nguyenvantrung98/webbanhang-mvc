// C2 : Sử dụng Reader và javascrip để load background img lên
function onChange(){
	// get thông tin của ảnh ở vị trí 0
	var a = document.getElementById('file').files[0];
	// console.log(a);
	// dùng reader để đọc thông tin của file upload đó , ở đây là image
	var reader = new FileReader();
	// đã đọc xong
	reader.onloadend = function(){
		// document.getElementById('anhdaidien').style.backgroundImage = "url(" + reader.result + ")";
		// var img = document.getElementById("");
		// img.src = reader.result;
		var src = document.getElementById("img1");
		src.src = reader.result;
		// console.log(src.src);
		src.style.opacity ='1';
		// var xem = document.getElementById('xem');
		// xem.href = src.src;
		// src.appendChild("src = 'src1'"); //dán img vào
		// console.log(reader);    
	}

 	// nếu a tồn tại or đúng thì sẽ thực hiện đổ dữ liệu vào , ở đây là background img
 	if(a){
 		reader.readAsDataURL(a);
 	}else{
 	}

 	// ktra background-img của div có chưa , rồi thì làm mờ icon
 	var check = document.getElementById('img1');
 	if(check.src != null){
 		document.getElementById('label').style.opacity = '0.2';
 	}
}

// khi load lại trang thì tự động lấy ảnh mặc định của sản phẩm đó
var ac = document.getElementById('img1').src;
// console.log(ac);

// Xóa background và hiển thị icon thêm ảnh lại như cũ
//Sửa nên icon mặc định luôn luôn mờ
function removeBackgroundupdate(){
    // xóa img đi
    var a = document.getElementById('img1');
    a.src = ac;
}

// Xóa background và hiển thị icon thêm ảnh lại như cũ
function removeBackgroundadd(){
	// xóa img đi
	var a = document.getElementById('img1');
	//xóa img đi r cho nó mờ xuống
	a.removeAttribute('src');
	a.style.opacity = '0';
	// a.removeChild(a.src);
    // hiện icon thêm ảnh ra lại
    document.getElementById('label').style.opacity = '1';
}
