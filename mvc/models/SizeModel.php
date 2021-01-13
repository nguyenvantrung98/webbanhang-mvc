<?php 
class SizeModel extends DataBase{
    // thao tác với database
    public function getAll(){
        $listsize = "SELECT * FROM size ORDER BY IdSize DESC";
        return mysqli_query($this->conn,$listsize);
    }

    // lấy danh sách size theo id size
    public function getSizeId($id){
        $query = "SELECT * FROM size WHERE IdSize = $id";
        $result = mysqli_query($this->conn,$query);
        return $rs = mysqli_fetch_assoc($result);
    }

    // thêm size
    public function addSize($tensize,$chonkieusize,$ngaythem){
        $query = "INSERT INTO size(TenSize,IdKieuSize,created_at)
        VALUES('$tensize','$chonkieusize','$ngaythem')";
        return mysqli_query($this->conn,$query);
    }

    // sửa size
    public function updateSize($tensize,$chonkieusize,$ngaysua,$id){
        $query = "UPDATE size SET TenSize = '$tensize', updated_at = '$ngaysua' , IdKieuSize = '$chonkieusize' WHERE IdSize = '$id'";
        return mysqli_query($this->conn,$query);
    }

    // lấy danh sách size theo id kiêu size
    public function getListSizeId($id){
        $query = "SELECT * FROM size WHERE IdKieuSize = $id";
        return mysqli_query($this->conn,$query);
    }

    // lấy danh sách size theo id sản phẩm
    public function getListSizeIdSp($id){
        $query = "SELECT * FROM sanpham_size WHERE sanpham_IdSanPham = $id";
        return mysqli_query($this->conn,$query);
    }

    // xóa size
    public function xoaSize($id){
        $deletesize = "DELETE FROM sanpham_size WHERE sanpham_IdSanPham = $id";
        mysqli_query($this->conn,$deletesize);
    }

    // thêm size table sanpham_size
    public function addSize1($idsp,$idsize){
        $querytong1 = "INSERT INTO sanpham_size(sanpham_IdSanPham,size_IdSize) VALUES($idsp,$idsize);";
        return mysqli_query($this->conn,$querytong1);
    }

    public function deleteSize($id){
        $query = "DELETE FROM size WHERE IdSize = $id";
        return mysqli_query($this->conn,$query);
    }
}
?>