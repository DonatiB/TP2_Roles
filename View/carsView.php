<?php
require_once 'libs/smarty-3.1.39/libs/Smarty.class.php';

class CarsView{

    private $smarty;
    function __construct()
    {
        $this->smarty = new Smarty();
    }
    
    function viewHomeLocation(){
        header("Location: ".BASE_URL."home");
    }

    function viewBrandLocation($brand){
        header("Location: ".BASE_URL_BRAND."/$brand");
    }

    function viewAllCars($allCars, $log){  
        foreach($allCars as $images){
            $images->image = base64_encode($images->image);
        }            
        $this->smarty->assign('log', $log);
        $this->smarty->assign('allCars', $allCars);    
        $this->smarty->display('templates/allCars.tpl'); 
    }

    function carsByBrand($carsBrand, $brandTitle, $carsImg, $admin){
        foreach($carsImg as $images){
            $images->image = base64_encode($images->image);
        }  
        $this->smarty->assign('title', $brandTitle);
        $this->smarty->assign('carsBrand', $carsBrand);
        $this->smarty->assign('carsImg', $carsImg);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/carsBrand.tpl');
    }

    function viewDescription($carDescription, $carsImg, $admin){
        $this->smarty->assign('carDescription', $carDescription);
        $this->smarty->assign('carsImg', $carsImg);
        $this->smarty->assign('admin', $admin);
        $this->smarty->display('templates/carDescription.tpl');
    }
}