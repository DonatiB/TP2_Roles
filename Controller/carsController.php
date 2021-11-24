<?php
require_once './Model/carsModel.php';
require_once './View/carsView.php';
require_once './helpers/authHelper.php';


class CarsController{

    private $model;
    private $view;
    private $authHelper;
    function __construct()
    {
        $this->model = new CarsModel;
        $this->view = new CarsView;
        $this->authHelper = new AuthHelper();
    }

    function byBrand($brand){
        $admin =  $this->authHelper->checkLoggedIn();

        $carsBrand = $this->model->getCarsBrand($brand);
        $carsImg = $this->model->getImgCars();
        $brandTitle = $this->model->getBrandTitle($brand);
        $this->view->carsByBrand($carsBrand, $brandTitle, $carsImg, $admin);
    }

    function descriptionByCar($carDescription){
        $admin = $this->authHelper->checkLoggedIn(); 
        $carDescription = $this->model->descriptionByCarDB($carDescription);
        $carsImg = $this->model->getImgCars();
        $this->view->viewDescription($carDescription, $carsImg, $admin);
    }

    function deleteCar($brand, $id, $car){
        $this->authHelper->checkAdmin();
        $this->model->deleteCarDB($id, $car);
        $this->view->viewBrandLocation($brand);
    }

    function soldCar($brand, $sold){
        $this->authHelper->checkAdmin();;
        $this->model->soldCarDB($sold);
        $this->view->viewBrandLocation($brand);        
    }

    function onSaleCar($brand, $sold){
        $this->authHelper->checkAdmin();
        $this->model->onSaleCarDB($sold);
        $this->view->viewBrandLocation($brand);
    }

    function createCar(){  
        $this->authHelper->checkAdmin();
        if(!isset($_POST['sold'])){
            $sold = 0;    
        }else{
            $sold = 1;
        } 

        $this->model->createCarDB($_POST['car'], $_POST['brand'], $_POST['year'], $_POST['description'], $_POST['euro'], $sold);    

        if(isset($_FILES['photo'])){

            //retenemos toda la informacion
            $typeFile = $_FILES['photo']['type'];
            $nameFile = $_FILES['photo']['name'];
            $sizeFile = $_FILES['photo']['size'];
            //extraemos los binarios de la img
            $uploadedImg = fopen($_FILES['photo']['tmp_name'], 'r');
            $biImg = fread($uploadedImg, $sizeFile);
            $id = $this->model->getIdCarImg($_POST['car']);

            foreach($id as $item){
                $id_car = $item->id;
            }

            $this->model->saveImgCarDB($_POST['car'], $nameFile, $biImg, $typeFile, $id_car);
            $this->view->viewHomeLocation(); 
        } 
    }

    function showAllCars(){
        $this->authHelper->checkLoggedIn();
        $allCars = $this->model->getAllCars();
        $this->view->viewAllCars($allCars, null);
    }

    //VISITANTES
    function log(){  
        $log = 3; 
        return $log;
    }

    function byBrandVisit($brand){
        $log = $this->log();
        $carsBrand = $this->model->getCarsBrand($brand);
        $carsImg = $this->model->getImgCars();
        $brandTitle = $this->model->getBrandTitle($brand);
        $this->view->carsByBrand($carsBrand, $brandTitle, $carsImg, $log);
    }

    function showAllCarsVisit(){
        $log = $this->log();
        $allCars = $this->model->getAllCars();
        $this->view->viewAllCars($allCars, $log);
    }

    function descriptionByCarVisit($carDescription){
        $log = $this->log();
        $carDescription = $this->model->descriptionByCarDB($carDescription);
        $carsImg = $this->model->getImgCars();
        $this->view->viewDescription($carDescription, $carsImg, $log);
    }
}
