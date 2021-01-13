<?php 
class AdminHomeController extends Controller{
    function home(){
        // views
        $this->viewsAdmin("view-main" , ["page"=>"admin-trangchu","title"=>"Admin-Trang Chủ"]);
    }
}
?>