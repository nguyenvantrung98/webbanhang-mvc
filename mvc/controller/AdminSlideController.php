<?php 
class AdminSlideController extends Controller{
    public function slide($tbao){
        $noti = "";
        if($tbao == 'Thêm thành công' || $tbao == 'Cập nhật thành công' || $tbao == 'Xóa thành công'){
            $noti = $tbao;
        }
        $slide = $this->models("SlideModel");
        $this->viewsAdmin("view-main" , ["page"=>"admin-dsslide","listslide"=>$slide->getAll(),"tbao"=>$noti,"title"=>"Danh sách slide"]);
    }

    public function themslide(){
        $tbao = "";
        // nếu ng dùng kích thêm
        if(isset($_POST['addslide'])){
            $tenslide = $_POST['tenSlide'];
            $hinhanh = $_FILES['file'];
            $file = './public/upload/slide/'.$this->random().$hinhanh['name']; // đường dẫn
            $ngaythem = $this->ngayhientai();
            // lấy dữ liệu từ server khi ng dùng thêm
            // gửi qua model xử lý
            $addslide = $this->models("SlideModel");
            $kq = $addslide->addSlide($tenslide,$file,$ngaythem);

            if($kq === true){
                move_uploaded_file($hinhanh['tmp_name'],$file);
                $tbao = 'Thêm thành công';
                header("location: ./slide/".$tbao);
            }else{
                $tbao = 'Tên slide đã tồn tại';
            }
        }

        // mặc định là trả về view này
        $this->viewsAdmin("view-main",["page"=>"admin-themslide","tbao"=>$tbao,"title"=>"Thêm slide"]);
    }

    public function suaslide($id){
        // lấy dữ liệu gửi ra views
        $tbao = "";
        $tr = $this->models("SlideModel");
        $result = $tr->getSlideId($id);

        // xử lý khi ng dung kich sửa
        if(isset($_POST['updateslide'])){
            $hinhanh = $_FILES['file'];
            if($hinhanh['error'] > 0){
            // lấy ảnh cũ ra
                $file = $result['Hinh'];
            }else{
                $file = './public/upload/slide/'.$this->random().$hinhanh['name'];
            }
            $tenslide = $_POST['tenSlide'];
            $ngaysua = $this->ngayhientai();
            $updateslide = $this->models("SlideModel");
            $kq = $updateslide->updateSlide($tenslide,$file,$ngaysua,$id);

            if($kq === true){
                unlink($result['Hinh']);
                move_uploaded_file($hinhanh['tmp_name'],$file);
                $tbao = 'Cập nhật thành công';
                header("location: ../slide/".$tbao);
            }
            else{
                $tbao = 'Tên slide đã tồn tại';
            }
        }
        
        $this->viewsAdmin("view-main",["page"=>"admin-suaslide","title"=>"Sửa slide","chitietslide"=>$result,"tbao"=>$tbao]);
    }

    public function xoaslide($id){
        $slide = $this->models("SlideModel");
        $detail_slide = $slide->getSlideId($id);
        if(file_exists($detail_slide['Hinh'])){
            unlink($detail_slide['Hinh']);
        }
        if($slide->deleteSlide($id)){
            $tbao = "Xoá thành công";
        }else{
            $tbao = "Xoá thất bại";
        }
        header("location: ../slide/".$tbao);
    }
}
?>