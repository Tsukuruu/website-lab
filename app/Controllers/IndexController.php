<?php
namespace app\Controllers;

use App\Models\User;
use App\Models\Role;

class IndexController{

    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
    }

   public function index($errors = [])
   {    
       $users = (new User())::all($this->conn);
       $roles = (new Role())::all($this->conn);

       //for displaying role title in the table by user role id
       $role_titles = [];
       foreach($roles as $role){
           $role_titles[$role['id']] = $role['title'];
       }

       if(array_key_exists('auth', $_SESSION)){
            switch($_SESSION['role']){
                case 'common':
                    include_once 'views/common/home.php';
                    break;
                case 'admin':
                    include_once 'views/admin/home.php';
                    break;        
            }
       }else{
           include_once 'views/unauthorized/home.php';
       }
   }

   public function signup(){
    
    $roles = (new Role())::all($this->conn);

    if(array_key_exists('auth', $_SESSION)){
        header('Location: / ');
    }else {
        include_once 'views/unauthorized/signup.php';
    }
   }

   public function signin(){

    if(array_key_exists('auth', $_SESSION)){
        header('Location: /');
        return;
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $user = (new User())::byEmail($this->conn, $email);
    if($user){
        if(password_verify($password, $user['password'])){
            $_SESSION['auth'] = true;
            $role = (new Role())::byId($this->conn, $user['role_id']);
            $_SESSION['role'] = $role['title'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];
            header('Location: /');
        }
    }

    $errors = array('error_signin'=> 'Incorrect email or password.');
    $this->index($errors);
   }

   public function signout(){

    if(array_key_exists('auth', $_SESSION)){
        session_unset();
        session_destroy();
    }

    header('Location: /');
   }
}
?>