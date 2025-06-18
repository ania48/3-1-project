<?php
session_start();
require_once __DIR__ . '/../config/dbconnect.php';


$controller = $_GET['controller'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';


$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerName)) {
        $controllerInstance = new $controllerName();

        if (method_exists($controllerInstance, $action)) {
            
            $controllerInstance->$action();
        } else {
            
            http_response_code(404);
            echo "Error: Action '$action' not found in controller '$controllerName'.";
        }

    } else {
        
        http_response_code(404);
        echo "Error: Controller class '$controllerName' not found.";
    }

} else {
    
    http_response_code(404);
    echo "Error: Controller file '$controllerFile' not found.";
}
