<?php
namespace Route;
use App\Controllers\IndexController;
use App\Controllers\UserController;
use App\Controllers\CommentController;
class Route{
   function loadPage($db, $controllerName, $actionName = 'index'){
       switch ($controllerName) {
           case 'user':
                $controller = new UserController($db);
                break;  
            case 'comment':
                $controller = new CommentController($db);
                break;
           default:
               $controller = new IndexController($db);
       }
       $controller->$actionName();
   }
}
?>
