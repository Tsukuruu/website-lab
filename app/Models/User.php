<?php
namespace app\Models;
class User {

    private $name;
    private $surname;
    private $email;
    private $img_url;
    private $password;
    private $role_id;
 
    public function __construct($name = '', $surname = '', $email = '', $role_id = '', $img_url = '', $password = '')
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->role_id = $role_id;
        $this->img_url = $img_url;
        $this->password = $password;
    }
 
    public function add($conn) {
        $sql = "INSERT INTO users (email, name, surname, role_id, password, img_url)
            VALUES ('$this->email', '$this->name','$this->surname', '$this->role_id', '$this->password', '$this->img_url')";
            $res = mysqli_query($conn, $sql);
            if ($res) {
                return true;
            }
            return false;
    }
 
    public static function delete($conn, $id) {
         $sql = "DELETE FROM users WHERE id=$id";
         $res = mysqli_query($conn, $sql);
         if ($res) {
             return true;
         }
         return false;
     }
 
     public static function update($conn, $id, $data){
         $email = $data['email'];
         $name = $data['name'];
         $surname = $data['surname'];
         $role_id = $data['role_id'];
         $img_url = $data['img_url'];
         $password = $data['password'];
         $sql = "UPDATE users SET email = '$email', name = '$name', surname = '$surname', img_url = '$img_url', role_id = '$role_id', password = '$password' WHERE id = $id";
         $res = mysqli_query($conn, $sql);
         if($res){
             return true;
         }
         return false;
     }
 
  
    public static function all($conn) {
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql); //виконання запиту
        if ($result->num_rows > 0) {
            $arr = [];
            while ( $db_field = $result->fetch_assoc() ) {
                $arr[] = $db_field;
            }
            return $arr;
        } else {
            return [];
        }
    }
 
    public static function byId($conn, $id){
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
         return $result->fetch_assoc();
        } else {
         return false;
        }
    }

    public static function byEmail($conn, $email){
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }
 }