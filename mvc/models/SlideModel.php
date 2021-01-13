<?php 
class SlideModel extends DataBase{
    // thao tác với database
    public function getAll(){
        $listslide = "SELECT * FROM slide ORDER BY IdSlide DESC";
        return mysqli_query($this->conn,$listslide);
    }

    public function getSlideId($id){
        $query = "SELECT * FROM slide WHERE IdSlide = $id";
        $result = mysqli_query($this->conn,$query);
        return $rs = mysqli_fetch_assoc($result);
    }

    public function addSlide($tenslide,$file,$ngaythem){
        $query = "INSERT INTO slide(TenSlide,Hinh,created_at) VALUES('$tenslide','$file','$ngaythem')";
        return mysqli_query($this->conn,$query);
    }

    public function updateSlide($tenslide,$file,$ngaysua,$id){
        $query = "UPDATE slide SET TenSlide = '$tenslide' , Hinh = '$file' , updated_at = '$ngaysua'
                     WHERE IdSlide =$id";
        return mysqli_query($this->conn,$query);
    }

    public function deleteSlide($id){
        $query = "DELETE FROM slide WHERE IdSlide = $id";
        return mysqli_query($this->conn,$query);
    }
}
?>