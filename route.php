<?php
require_once './Controller/carsController.php';
require_once './Controller/loginController.php';
require_once './Controller/brandController.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER['PHP_SELF']).'/');
define('BASE_URL_BRAND', '//'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].dirname($_SERVER['PHP_SELF']).'/brand'); 

if(!empty($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'home';
}

$paramsURL = explode('/', $action);

$brandController = new BrandController();
$carsController = new CarsController();
$loginController = new LoginController();


switch($paramsURL[0]){
    case 'login':
        $loginController->login();
    break;
    case 'logout':
        $loginController->logout();
    break;
    case 'registration':
        $loginController->registration();
    break;
    case 'newUser':
        $loginController->newUser();
    break;
    case 'verify':
        $loginController->verifyLogin();
    break;
    case 'home':
        $carsController->home();
    break;
    case 'allCars':
        $carsController->showAllCars();
    break;
    case 'brand':
        $carsController->byBrand($paramsURL[1]);       
    break;
    case 'description':
        $carsController->descriptionByCar($paramsURL[1]);       
    break;
    case 'deleteCar':
        $carsController->deleteCar($paramsURL[1], $paramsURL[2]);       
    break;
    case 'soldCar':
        $carsController->soldCar($paramsURL[1], $paramsURL[2]);       
    break;
    case 'onSaleCar': 
        $carsController->onSaleCar($paramsURL[1], $paramsURL[2]);    
    break;
    case 'createCar': 
        $carsController->createCar(); 
    break;
    case 'saveImgCar': 
        $carsController->saveImgCar();    
    break;
    case 'saveLogo': 
        $carsController->saveLogo();    
    break;
    case 'createBrand': 
        $carsController->createBrand();    
    break;
    case 'deleteBrand': 
        $carsController->deleteBrand($paramsURL[1]);    
    break;
    case 'modifiedName': 
        $carsController->modifiedName();    
    break;
    default:
        echo 'Error 404 Page not found';
    break;
}