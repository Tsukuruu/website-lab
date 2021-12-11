<?php
namespace Route;
use App\Controllers\IndexController;
class Route{
   function loadPage($db, $controllerName, $actionName = 'index'){
       switch ($controllerName) {  
           default:
               $controller = new IndexController($db);
       }
       $controller->$actionName();
   }
}
?>
