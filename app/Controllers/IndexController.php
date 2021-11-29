<?php
class IndexController{

    private $conn;
    public function __construct($db)
    {
        $this->conn = $db->getConnect();
    }

   public function index()
   {
       include_once 'views/home.html';
   }
}
?>