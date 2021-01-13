<meta charset="UTF-8">
	<meta name="mota" content="Danh sách sản phẩm">
	<base href="http://localhost/webbanhang-mvc/">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="./public/css/style.css">
	<!-- <link rel="stylesheet" href="./public/vendors/css/grid.css"> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- load lại trang sau 10s -->
	<!-- <meta http-equiv="refresh" content="1"> -->
	<!-- favicon cho trang web -->
	<link rel="shortcut icon" type="image/png" href="./public/img/footer/logo1.png"/>
	<!-- SEO cho trang -->
	<meta name="tukhoa" content="Quan-ao,Giay-dep,Phu-kien">
	<!-- giúp kiểm soát kích thước của trang khi thu nhỏ -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- tác giả -->
	<meta name="tacgia" content="Nguyễn Văn Trung">
	<style type="text/css">
		#back-to-top {
			position: fixed;
			right: 30px;
			bottom: 60px;
			z-index: 9999;
			background-color: #f7442e;
			padding: 10px;
			border: 1px solid transparent;
			border-radius: 4px;
			color: white;
			font-size: 20px;
			outline: none;
			cursor: pointer;
			mix-blend-mode: difference;
		}
		
	</style>
</head>
<body>
<button onclick="scrollToTop()" id="back-to-top" title="Scroll to Top" type="button" class="btn btn-success"
        style="display: block; opacity: 1;">▲</button>
<header id="home-admin">
	<nav id="nav">
		<div class="header-main">
			<div class="logo-header">
				<a href="./AdminHomeController/home">
					<img src="./public/upload/logo/logo1.png">
				</a>
			</div>
			<div class="search-header">
				<form>
					<div class="timkiem-header">
						<input type="text" name="timkiem" placeholder="Tìm kiếm">
						<button title="Tìm kiếm" type="submit"><i class="fas fa-search"></i></button>
					</div>
				</form>
			</div>
			<div class="info-admin">
				<li><a href=""><i class="fas fa-bell"></i></a></li>
				<li><a href="./AdminTaiKhoanController/thongtincanhan/<?=$_SESSION['infouser']['id']?>/info"><i class="fas fa-user"></i><?=$_SESSION['infouser']['username']?></a>
					<div id="logout" class="logout">
						<div>
							<a href="./AdminTaiKhoanController/thongtincanhan/<?=$_SESSION['infouser']['id']?>/info"><i class="fas fa-users-cog"></i>Thông tin cá nhân</a>
						</div>
						<div>
							<a href="./TaiKhoanController/logout"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
						</div>
					</div>
				</li>
			</div>
		</div>
	</nav>
</header>