<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
//For using env variables
use Dotenv\Dotenv;
$dotEnv = Dotenv::createImmutable(__DIR__);
$dotEnv->load();

// $s3 = new Aws\S3\S3Client([
//     'version'  => '2006-03-01',
//     'region'   => 'us-east-1',
// ]);
// $bucket = $_ENV['S3_BUCKET']?: die('No "S3_BUCKET" config var in found in env!');

use Config\Db;
use Route\Route;

$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'index';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

$routing = new Route();
$db = new Db();

$routing->loadPage($db, $controllerName, $actionName);
?>