<?php
require_once 'libs/smarty-3.1.39/libs/Smarty.class.php';

class BrandView{

    private $smarty;
    function __construct()
    {
        $this->smarty = new Smarty();
    }

    function viewHomeLocation(){
        header("Location: ".BASE_URL."home");
    }

    function viewHome($allBrands, $brandsLogo, $allCars, $allBrandsAndCar, $admin){     
        foreach($allBrands as $images){
            $images->image = base64_encode($images->image);
        }        
        $this->smarty->assign('allBrands', $allBrands);   
        $this->smarty->assign('allBrandsAndCar', $allBrandsAndCar);  
        $this->smarty->assign('brandsLogo', $brandsLogo);
        $this->smarty->assign('allCars', $allCars);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/home.tpl'); 
    }
}