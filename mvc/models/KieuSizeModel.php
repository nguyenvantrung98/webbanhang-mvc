<?php 
class KieuSizeModel extends DataBase{
    // thao tác với database
    public function getAll(){
        $listkieusize = "SELECT * FROM kieusize ORDER BY IdKieuSize DESC";
        return mysqli_query($this->conn,$listkieusize);
    }

    public function getKieuSizeId($id){
        $query = "SELECT * FROM kieusize WHERE IdKieuSize = $id";
        $result = mysqli_query($this->conn,$query);
        return $rs = mysqli_fetch_assoc($result);
    }

    public function addKieuSize($tenkieusize,$ngaythem){
        $query = "INSERT INTO kieusize(TenKieuSize,created_at)
                 VALUES('$tenkieusize','$ngaythem')";
        return mysqli_query($this->conn,$query);
        // return mysqli_fetch_assoc($result);
    }

    public function updateKieuSize($tenkieusize,$ngaysua,$id){
        $query = "UPDATE kieusize set TenKieuSize = '$tenkieusize', updated_at = '$ngaysua' WHERE IdKieuSize = '$id'";
        return mysqli_query($this->conn,$query);
    }

    public function deleteKieuSize($id){
        $query = "DELETE FROM kieusize WHERE IdKieuSize = $id";
        return mysqli_query($this->conn,$query);
    }
}
?>