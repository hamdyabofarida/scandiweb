<?php
include './includes/autoLoader.php';
function cors(){
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])){
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        }
        
        if(isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])){
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
        exit(0);
    }
}

cors();

$_POST = json_decode(file_get_contents('php://input'), true);

use Controller as C;

$controller = new C\Controller();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addProduct'])) {
        $type = $_POST['type'];
        $class =  __NAMESPACE__ . '\\Controller\\' . $type;
        $obj = new $class;
        $controller->addProductAndValue($obj);
    } else if (isset($_POST['getAttr'])) {
        $controller->getAttrs();
    }
    else if (isset($_POST['toDelete'])) {
        $controller->deleteProducts();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    $controller->getProducts();
}
