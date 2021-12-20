<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
//For using env variables
// use Dotenv\Dotenv;
// $dotEnv = Dotenv::createImmutable(__DIR__);
// $dotEnv->load();

use Config\Db;
use Route\Route;

$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'index';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

$routing = new Route();
$db = new Db();

$routing->loadPage($db, $controllerName, $actionName);
?>