<?php 
class TheLoaiController extends Controller{
	public function categories($category){
		$title = "";
		$category = $this->models("TheLoaiModel");
		$product = $this->models("SanPhamModel");
		$picture = $this->models("HinhAnhModel");
		$listcategory = $category->getAll();

		$list_image = [];
		$listproduct = $product->getSanPhamHome("categorys");

		if($category == "list"){
			$title = "Tất cả sản phẩm";
		}
		// bỏ dữ liệu vào list_image
		foreach ($listproduct as $key => $value) {
			$list_image[$key] = $picture->getHinhAnhIdSanPham($value['IdSanPham']);
		}
		
		$this->viewsUsers("danhsachtheloai",['title'=>$title,'listcategory'=>$listcategory,'listproduct'=>$listproduct,'list_image'=>$list_image]);
	}
}
?>