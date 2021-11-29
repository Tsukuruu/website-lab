<?php
class Route{
   function loadPage($db, $controllerName, $actionName = 'index'){
       require_once 'app/Controllers/IndexController.php';
       switch ($controllerName) {  
           default:
               $controller = new IndexController($db);
       }
       $controller->$actionName();
   }
}
?>
