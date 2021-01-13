	//khai báo biến slideIndex đại diện cho slide hiện tại
var slideIndex = 0;
      // KHai bào hàm hiển thị slide
      function showSlides() {
      	var i;
      	var slides = document.getElementsByClassName("slide");
      	// var dots = document.getElementsByClassName("dot");
      	for (i = 0; i < slides.length; i++) {
      		slides[i].style.display = "none";  
      	}
      	// for (i = 0; i < dots.length; i++) {
      	// 	dots[i].className = dots[i].className.replace(" active", "");
      	// }

      	slides[slideIndex].style.display = "block"; 
        // slides[slideIndex].className += " active";
      	// dots[slideIndex].className += " active";
          //chuyển đến slide tiếp theo
        slideIndex++;
          //nếu đang ở slide cuối cùng thì chuyển về slide đầu
          if (slideIndex > slides.length - 1) {
          	slideIndex = 0;
          }    
          //tự động chuyển đổi slide sau 5s
          setTimeout(showSlides, 4000);
      }


      //mặc định hiển thị slide đầu tiên 
      showSlides();


      function next(n) {
      	showSlides(slideIndex = n);
      }



      // pre-next menu
      var dem =0;
      // var maxWidth = 112;
      function pre(){
      	var c = document.getElementById('danhsachdanhmuc');
      	// console.log(c);
      	if (c.style.left == '0px') {
      		// c.style.setAttribute('disabled','disabled');
      	}
      	else{
      		var dem2 = dem+(112);
      		c.style.left = dem2+'px';
      		c.style.transition = 'all 0.2s';
      		dem = dem2;
      		// console.log(dem2);
      		// console.log(c);
      	}
      	// console.log(check);

      	// var d = document.getElementsByClassName('hinhanh-danhmuc').length;
      	// console.log(d*112);
      }

      // pre-next thể loại
      function next(){
      	var dem1 = dem+(-112);
      	var c1 = document.getElementById('danhsachdanhmuc');
      	c1.style.left = dem1+'px';
      	c1.style.transition = 'all 0.2s';
      	dem = dem1;
      	if(dem1 == '-1008'){
      		c1.style.left = '0';
      		dem = 0;
      	}
      	// console.log(dem1);
      	// console.log(dem);
      }