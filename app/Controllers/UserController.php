<?php
namespace app\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\Comment;
use Aws\S3\S3Client;

class UserController
{
   private $conn;
   public function __construct($db)
   {
       $this->conn = $db->getConnect();
   }

   public function index()
   {
       
       $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $user = (new User())::byId($this->conn, $id);

       if(!$user){
           header('Location: /');
           return;
       }

       $roles = (new Role())::all($this->conn);
        //for displaying role title in the table by user role id
        $role_titles = [];
        foreach($roles as $role){
            $role_titles[$role['id']] = $role['title'];
        }

        $users = (new User())::all($this->conn);
        $usernames = [];
        foreach($users as $u){
            $usernames[$u['id']] = $u['name'] . " " . $u['surname'];
        }

        $comments = (new Comment())::byReceiverId($this->conn, $id);

       if(!array_key_exists('auth', $_SESSION)){
            include_once 'views/unauthorized/user.php';
            return;
        }

       switch($_SESSION['role']){
           case 'admin':
                include_once 'views/admin/user.php';
                break;
           case 'common':
                include_once 'views/common/user.php';
                break;
            default:
                header('Location: /');
       }
   }

   public function add()
   {
       $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
       $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $role_id = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       if((new User())::byEmail($this->conn, $email)){
           $error = "This email already exists.";
           $roles = (new Role())::all($this->conn);
           if(array_key_exists('auth', $_SESSION)){

                $users = (new User())::all($this->conn);
                $roles = (new Role())::all($this->conn);
     
                //for displaying role title in the table by user role id
                $role_titles = [];
                foreach($roles as $role){
                    $role_titles[$role['id']] = $role['title'];
                }
               include_once 'views/admin/home.php';
           }else{
             include_once 'views/unauthorized/signup.php';
           }
           return;
       }

        $user = new User($name, $surname, $email, $role_id, '', password_hash($password, PASSWORD_DEFAULT));
        $user->add($this->conn);
        //user will be authorized after sign up
        $_SESSION['auth'] = true;
        $role = (new Role())::byId($this->conn, $role_id);
        $_SESSION['role'] = $role['title'];
        $_SESSION['user_name'] = $name;
        $_SESSION['user_id'] = (new User())::byEmail($this->conn, $email)['id'];
        header('Location: /');
   }

    public function update(){
        if(!array_key_exists('auth', $_SESSION)){
            header('Location: /');
            exit();
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, 'surname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $role_id = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $role_id = $role_id ? $role_id : (new User())::byId($this->conn, $id)['role_id'];

        if(!getimagesize($_FILES['avatar']['tmp_name']) || $_FILES['avatar']['size'] > 500000){
            header("Location: ?controller=user&id=" . $id);
            return;
        }
        
        $s3 = new S3Client([
            'version'  => '2006-03-01',
            'region'   => $_ENV['S3_REGION'],
            'credentials' => [
                'key'    => $_ENV['AWS_ACCESS_KEY_ID'],
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
            ],
        ]);

        $upload = $s3->putObject([
            'Bucket' => $_ENV['S3_BUCKET'],
            'Key' => $_FILES['avatar']['name'],
            'SourceFile' => $_FILES['avatar']['tmp_name'],
            'ContentType' => 'image'
        ]);

        $img_url = "https://". $_ENV['S3_BUCKET'].".s3.".$_ENV['S3_REGION'].".amazonaws.com/".$_FILES['avatar']['name'];

        $data = [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'password'=> $password,
            'role_id'=> $role_id,
            'img_url' => $img_url
        ];
        if (trim($id) !== "" && is_numeric($id)) {
            (new User())::update($this->conn, $id, $data);
        }
        
        header("Location: ?controller=user&id=" . $id);
    }


   public function delete() {

    if($_SESSION['role'] != 'admin'){
        header('Location: /');
        return;
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $user = (new User())::byId($this->conn, $id);
    if($user){
        if($user['id'] == $_SESSION['user_id']){
            (new User())::delete($this->conn, $id);
            header('Location: ?action=signout');
            return;
        }else{
            (new User())::delete($this->conn, $id);
            header('Location: /');
            return;
        }
    }
 }
 
}