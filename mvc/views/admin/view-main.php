<!DOCTYPE html>
<html>
<head>
</head>
	<title><?php echo $data['title'];?></title>
	
	<?php require_once 'admin-header.php';?>

	<section class="main-admin">
		<?php require_once 'admin-menu.php';?>

		<!-- content -->
		<?php require_once $data['page'].".php";?>
	</section>

	<?php require_once 'admin-footer.php';?>
	
</body>
<script src="./public/js/toggleMenu.js"></script>
<script src = "https://code.highcharts.com/highcharts.js"> </script>
<script src="./public/js/chartjs.js"></script>
<script src="./public/js/validate-form.js"></script>
<!-- <script src="./public/js/imgsuasanpham.js"></script> -->
<script src="./public/js/uploadImage.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
    if ($(window).scrollTop() > 200) {
        $('#back-to-top').fadeIn();
    } else {
        $('#back-to-top').fadeOut();
    }
 
	$(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
	});
    
	$('#back-to-top').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
});
</script>
</html>