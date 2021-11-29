<?php
class Db {
   public function getConnect(){
      $conn = mysqli_connect("eu-cdbr-west-01.cleardb.com",
      "b83cf71c9fb28a", "42f8a091", "heroku_0f11ff9a9927f56");

      if (!$conn) {
          echo "Could not connect MySQL.";
          echo "Error code: " . mysqli_connect_errno();
          echo "Error message: " . mysqli_connect_error();
          exit();
      }
      return $conn;
  }
}
?>