<?php 
class AdminKieuSizeController extends Controller{
    public function kieusize($tbao){
        if($tbao != 'Thêm thành công' && $tbao != 'Cập nhật thành công'){
            $tbao = "";
        }
        $kieusize = $this->models("KieuSizeModel");
        $this->viewsAdmin("view-main" , ["page"=>"admin-dskieusize","listkieusize"=>$kieusize->getAll(),"tbao"=>$tbao,"title"=>"Danh sách kiểu size"]);
    }

    public function themkieusize(){
        $tbao = "";
        // nếu ng dùng kích thêm
        if(isset($_POST['addKieuSize'])){
            $ten = $_POST['tenKieuSize'];
            $ngaythem = $this->ngayhientai();
            // lấy dữ liệu từ server khi ng dùng thêm
            // gửi qua model xử lý
            $adddanhmuc = $this->models("KieuSizeModel");
            $kq = $adddanhmuc->addKieuSize($ten,$ngaythem);
            if($kq === true){
                $tbao = 'Thêm thành công';
                header("location: ./kieusize/".$tbao);
            }else{
                $tbao = 'Tên kiểu size đã tồn tại';
            }
        }
        // mặc định là trả về view này
        $this->viewsAdmin("view-main",["page"=>"admin-themkieusize","tbao"=>$tbao,"title"=>"Thêm kiểu size"]);
    }

    public function suakieusize($a){
        // lấy dữ liệu gửi ra views
        $tbao = "";
        $ks = $this->models("KieuSizeModel");
        $result = $ks->getKieuSizeId($a);

        // xử lý khi ng dung kich sửa
        if(isset($_POST['updatekieusize'])){
            $id = $a;
            $tenkieusize = $_POST['tenKieuSize'];
            $ngaysua = $this->ngayhientai();
            // echo $tenkodau;
            $update = $this->models("KieuSizeModel");
            $kq = $update->updateKieuSize($tenkieusize,$ngaysua,$id);
            if($kq === true){
                $tbao = 'Cập nhật thành công';
                 header("location: ../kieusize/".$tbao);
            }
            else{
                $tbao = 'Tên kiểu size đã tồn tại';
            }
        }
        $this->viewsAdmin("view-main",["page"=>"admin-suakieusize","title"=>"Sửa kiểu size","chitietkieusize"=>$result,"tbao"=>$tbao]);
    }


    public function size($tbao){
        if($tbao != 'Thêm thành công' && $tbao != 'Cập nhật thành công' && $tbao != 'Xóa thành công'){
            $tbao = "";
        }
        $size = $this->models("SizeModel");
        $this->viewsAdmin("view-main" , ["page"=>"admin-dssize","listsize"=>$size->getAll(),"tbao"=>$tbao,"title"=>"Danh sách size"]);
    }

    public function themsize(){
        $tbao = "";
        $kieusize = $this->models("KieuSizeModel");
        $result1 = $kieusize->getAll();
        // nếu ng dùng kích thêm
        if(isset($_POST['addsize'])){
			$tensize = $_POST['tensize'];
			$chonkieusize = $_POST['chonkieusize'];
			$ngaythem = $this->ngayhientai();
			$addsize = $this->models("SizeModel");
			$kq = $addsize->addSize($tensize,$chonkieusize,$ngaythem);
			if($kq === true){
				$tbao = 'Thêm thành công';
				header("location: ./size/".$tbao);
			}else{
				$tbao = 'Tên thể loại đã tồn tại';
			}
		}
        // mặc định là trả về view này
        $this->viewsAdmin("view-main",["page"=>"admin-themsize","tbao"=>$tbao,"listkieusize"=>$result1,"title"=>"Thêm size"]);
    }

    public function suasize($a){
        // lấy dữ liệu gửi ra views
        $tbao = "";
        $size = $this->models("SizeModel");
        $result = $size->getSizeId($a);

        $kieusize = $this->models("KieuSizeModel");
        $result1 = $kieusize->getAll();

        // xử lý khi ng dung kich sửa
        if(isset($_POST['addsize'])){
            $id = $a;
            $tensize = $_POST['tensize'];
            $ngaysua = $this->ngayhientai();
            $chonkieusize = $_POST['chonkieusize'];
            $update = $this->models("SizeModel");
            $kq = $update->updateSize($tensize,$chonkieusize,$ngaysua,$id);
            if($kq === true){
                $tbao = 'Cập nhật thành công';
                header("location: ../size/".$tbao);
            }
            else{
                $tbao = 'Tên size đã tồn tại';
            }
        }

        $this->viewsAdmin("view-main",["page"=>"admin-suasize","title"=>"Sửa size","chitietsize"=>$result,"listkieusize"=>$result1,"tbao"=>$tbao]);
    }

    public function xoakieusize($id){
        $kieusize = $this->models("KieuSizeModel");
        // xóa sản phẩm
        $kieusize->deleteKieuSize($id);
        $tbao = "Xóa thành công";
        header("location: ../kieusize/".$tbao);
    }

     public function xoasize($id){
        $size = $this->models("SizeModel");
        // xóa sản phẩm
        $size->deleteSize($id);
        $tbao = "Xóa thành công";
        header("location: ../size/".$tbao);
    }
}
?>