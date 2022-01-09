<?php
require "Utils/DB.php";
require "Utils/TokenService.php";
require "Utils/Cookie.php";
require "Utils/Session.php";
require "Utils/AuthService.php";
require "Utils/FileLoader.php";

require "Settings/Settings.php";

require "Controllers/RestController.php";

session_start();
$path_info = explode( '/',$_SERVER['REQUEST_URI']);
$controller_name = $path_info[count($path_info)-2];
$action = $path_info[count($path_info)-1];




require "Controllers/".ucfirst($controller_name)."Controller.php";



$request_data = json_decode(file_get_contents("php://input"));
$data = array("request_data"=>$request_data, "headers"=>getallheaders());

$controller->execute($action, $db, $data);


?>
