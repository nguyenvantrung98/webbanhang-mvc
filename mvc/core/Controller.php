<?php
class Controller{
    function __construct(){
        // mở các tài khoản bị khóa tự động
        // lấy các tài khoản bị khóa lên
        $taikhoan = $this->models("TaiKhoanModel");
        $kq = $taikhoan->getTaiKhoanTrangThai(2);
        $row = mysqli_num_rows($kq);
        // nếu có tài khoản đang bị khóa
        if($row > 0){
            // so sánh ngày hiện tại vs ngày mở khóa xem có bằng nhau chưa
            while ($rs = mysqli_fetch_assoc($kq)) {
                // sử dụng hàm strtotime để so sánh
                if($this->ngayhientai() >= $rs['ngay_mokhoa']){
                    // cập nhật trạng thái cho tài khoản đó
                    $taikhoan->unlockTaiKhoan($rs['IdUser']);
                }
            }
        }else{
            // ko xử lý
        }

        // kiểm tra session có tồn tại hay ko
        if(!isset($_SESSION['infouser']) && empty($_SESSION['infouser'])){ // xảy ra khi đóng trình duyệt
            if(isset($_COOKIE['remember'])){ //ktra xem ng dùng có chọn remember ko
                $taikhoan = $this->models("TaiKhoanModel");
                $kq = $taikhoan->getTaiKhoanEmail($_COOKIE['remember']);
                $rs = mysqli_fetch_assoc($kq);
                // lưu thông tin tài khoản vào session và chuyển về trang chủ
                $_SESSION['infouser'] = array(
                    "id" => $rs['IdUser'],
                    "email" => $rs['TenDangNhap'],
                    "username" => $rs['HoTen'],
                    "password" => $rs['MatKhau'],
                    "phone" => $rs['SoDienThoai'],
                    "address" => $rs['DiaChi'],
                    "gender" => $rs['GioiTinh'],
                    "birthday" => $rs['NgaySinh'],
                    "image" => $rs['AnhDaiDien']
                );
                header("location: ../HomeController/home");
            }else{
                setcookie("lifetime", "" , time() - 900 , "/");
            }
        }else{ // trường hợp ng dùng vẫn đang đăng nhập
            if(isset($_COOKIE['lifetime'])){ // ktra xem ng dùng có đang hoạt động ko
                 // nếu ng có thao tác thì cookie nó vẫn tồn tại thgian là 15p
                setcookie("lifetime" , "" , time() - 900 , "/");
                setcookie("lifetime" , "15" , time() + 900 , "/");
            }
            else{ // tr/hop ng dùng ko thao tác trong vòng 15p
                // // xóa session trả về trang login
                setcookie("remember" , "" , time() - (3600 * 24) , "/");
                session_destroy();
                header("location: http://localhost/webbanhang-mvc/TaiKhoanController/login");
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function checkLogin(){
        if(!isset($_SESSION['infouser'])){
           header("location: http://localhost/webbanhang-mvc/TaiKhoanController/login");
           exit();
        }
    }

    // ngày cố định
    public function ngayhientai(){
        return date('Y-m-d H:i:s');
    }

    // random
    public function random(){
        // random
        $shuffle = str_repeat("0123456789qwertyuioplkjhgfdsaxzcvbnm",5); //chuỗi ngẫu nhiên
        $random = substr(str_shuffle($shuffle), 0, 15);
        return $random;
    }

    // hàm xóa dấu 
    public function xoadau($str){
        if(!$str) return false;
        $unicode = array('a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ','D'=>'Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ','Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ');
        foreach($unicode as $khongdau=>$codau) {
            $arr=explode("|",$codau); //chuyen chuoi thanh mang
            $str1 = str_replace($arr,$khongdau,$str);
            $str = str_replace(' ','-',$str1);
        }
        return $str;
    }

    // phần thao tác với model
    public function models($model){
        require_once "./mvc/models/"."$model".".php";
        return new $model;
    }

    // giao diện chính của phần admin
    public function viewsAdmin($view , $data = []){
        require_once "./mvc/views/admin/"."$view".".php";
    }

    // giao diện chính của phần users
    public function viewsUsers($view , $data = []){
        require_once "./mvc/views/users/"."$view".".php";
    }
    
}
?>