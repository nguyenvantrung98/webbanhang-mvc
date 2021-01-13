<?php 
class AdminDanhMucController extends Controller{
    public function danhmuc($tbao){
        if($tbao != 'Thêm thành công' && $tbao != 'Cập nhật thành công' && $tbao != 'Xóa thành công'){
            $tbao = "";
        }
        $danhmuc = $this->models("DanhMucModel");
        $this->viewsAdmin("view-main" , ["page"=>"admin-dsdanhmuc","listdanhmuc"=>$danhmuc->getAll(),"tbao"=>$tbao,"title"=>"Danh sách danh mục"]);
    }

    public function themdanhmuc(){
        $tbao = "";
        // nếu ng dùng kích thêm
        if(isset($_POST['buttonDanhMuc'])){
            $ten = $_POST['tenDanhMuc'];
            $tenkodau = $this->xoadau($ten);
            $date = $this->ngayhientai();
            // lấy dữ liệu từ server khi ng dùng thêm
            // gửi qua model xử lý
            $adddanhmuc = $this->models("DanhMucModel");
            $kq = $adddanhmuc->addDanhMuc($ten,$tenkodau,$date);
            if($kq === true){
                $tbao = 'Thêm thành công';
                header("location: ./danhmuc/".$tbao);
            }else{
                $tbao = 'Tên danh mục đã tồn tại';
            }
        }
        // mặc định là trả về view này
        $this->viewsAdmin("view-main",["page"=>"admin-themdanhmuc","tbao"=>$tbao,"title"=>"Thêm danh mục"]);
    }

    public function suadanhmuc($a){
        // lấy dữ liệu gửi ra views
        $tbao = "";
        $tr = $this->models("DanhMucModel");
        $result = $tr->getDanhMucId($a);

        // xử lý khi ng dung kich sửa
        if(isset($_POST['buttonDanhMuc'])){
            $id = $a;
            $tendanhmuc = $_POST['tenDanhMuc'];
            $tenkodau = $this->xoadau($tendanhmuc);
            $dateupdate = $this->ngayhientai();
            // echo $tenkodau;
            $updatedanhmuc = $this->models("DanhMucModel");
            $kq = $updatedanhmuc->updateDanhMuc($tendanhmuc,$tenkodau,$dateupdate,$id);
            if($kq === true){
                $tbao = 'Cập nhật thành công';
                header("location: ../danhmuc/".$tbao);
            }
            else{
                $tbao = 'Tên danh mục đã tồn tại';
            }
        }
        $this->viewsAdmin("view-main",["page"=>"admin-suadanhmuc","title"=>"Sửa danh mục","chitietdanhmuc"=>$result,"tbao"=>$tbao]);
    }

    public function xoadanhmuc($id){
        $danhmuc = $this->models("DanhMucModel");
        $theloai = $this->models("TheLoaiModel");
        
        // xóa hình trc 
        $kq = mysqli_fetch_assoc($theloai->getTheLoaiIdDanhMuc($id));
        if(file_exists($kq['AnhDaiDien'])){
            unlink($kq['AnhDaiDien']);
        }
        // xóa danh mục
        $danhmuc->deleteDanhMuc($id);
        $tbao = "Xóa thành công";
        header("location: ../danhmuc/".$tbao);
    }
}
?>