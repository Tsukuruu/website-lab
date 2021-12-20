<?php
namespace app\Models;
class Comment{

   private $author_id;
   private $receiver_id;
   private $text;
   private $date;

   public function __construct($author_id = '', $receiver_id = '', $text = '')
   {
       $this->author_id = $author_id;
       $this->receiver_id = $receiver_id;
       $this->text = $text;
       $this->date = date('Y-m-d H:i:s');
   }

   public function add($conn) {
       $sql = "INSERT INTO comments (author_id, receiver_id, text, date) VALUES ('$this->author_id', ' $this->receiver_id', '$this->text', '$this->date')";
           $res = mysqli_query($conn, $sql);
           if ($res) {
               return true;
           }
           return false;
   }

   public static function delete($conn, $id) {
        $sql = "DELETE FROM comments WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            return true;
        }
        return false;
    }

    public static function update($conn, $id, $data){
        $text = $data['text'];
        $sql = "UPDATE comments SET text = '$text' WHERE id = $id";
        $res = mysqli_query($conn, $sql);
        if($res){
            return true;
        }
        return false;
    }

 
   public static function all($conn) {
       $sql = "SELECT * FROM comments";
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
       $sql = "SELECT * FROM comments WHERE id = $id";
       $result = $conn->query($sql);
       if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
   }

   public static function byReceiverId($conn, $id){
    $sql = "SELECT comments.id, `author_id`, `receiver_id`, `text`, `date`, `name`, `surname` FROM `comments` LEFT JOIN users ON comments.author_id = users.id WHERE `receiver_id` = $id";
    $result = $conn->query($sql);
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
}