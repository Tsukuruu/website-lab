<?php
namespace app\Controllers;
use App\Models\User;
use App\Models\Comment;

class CommentController
{
   private $conn;
   public function __construct($db)
   {
       $this->conn = $db->getConnect();
   }

   public function add()
   {
       $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $author_id = filter_input(INPUT_POST, 'author_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $receiver_id = filter_input(INPUT_POST, 'receiver_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

       if(trim($author_id) == "" || !is_numeric($author_id) || trim($receiver_id) == "" || !is_numeric($receiver_id)){
           header("Location: ?controller=user&id=" . $receiver_id);
           return;
       }

        $comment = new Comment($author_id, $receiver_id, $text);
        $comment->add($this->conn);
        header("Location: ?controller=user&id=" . $receiver_id);
   }

    public function update(){

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $data = [
            'text' => $text,
        ];
        if (trim($id) !== "" && is_numeric($id)) {
            (new Comment())::update($this->conn, $id, $data);
        }
        
        header("Location: ?controller=user&id=".$user_id);
    }


   public function delete() {

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (trim($id) !== "" && is_numeric($id)) {
        (new Comment())::delete($this->conn, $id);
    }

    header("Location: ?controller=user&id=".$user_id);
 }
 
}