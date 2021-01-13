<?php 
class DanhMucModel extends DataBase{
    public function getAll(){
        $listdanhmuc = "SELECT * FROM danhmuc ORDER BY IdDanhMuc DESC";
        return mysqli_query($this->conn,$listdanhmuc);
    }

    public function getDanhMucId($id){
        $query = "SELECT * FROM danhmuc WHERE IdDanhMuc = $id";
        $result = mysqli_query($this->conn,$query);
        return mysqli_fetch_assoc($result);
    }

    public function getNameDanhMucId($id){
        $query = "SELECT TenDanhMuc FROM danhmuc WHERE IdDanhMuc = $id";
        $result = mysqli_query($this->conn,$query);
        return mysqli_fetch_assoc($result);
    }

    public function addDanhmuc($tendanhmuc,$tenkhongdau,$ngaytao){
        $query = "INSERT INTO danhmuc(TenDanhMuc,TenKhongDau,created_at)
                 VALUES('$tendanhmuc','$tenkhongdau','$ngaytao')";
        return mysqli_query($this->conn,$query);
    }

    public function updateDanhMuc($tendanhmuc,$tenkhongdau,$ngaysua,$id){
        $query = "UPDATE danhmuc SET TenDanhMuc = '$tendanhmuc' , TenKhongDau = '$tenkhongdau' ,
             updated_at = '$ngaysua' WHERE IdDanhMuc = $id";
        return mysqli_query($this->conn,$query);
    }

    public function deleteDanhMuc($id){
        $query = "DELETE FROM danhmuc WHERE IdDanhMuc = $id";
        return mysqli_query($this->conn,$query);
    }
}
?>