<?php
  if( isset($_POST['submitCC']) ) {
    // Tên thư mục chứa file upload
    $target_dir = "img/img_cc/";

    // Tên file thao tác (tên ban đầu)
    $target_file = $target_dir . basename($_FILES["fileToUpload_CC"]["name"]);

    // Tên phần mở rộng của file
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Biến để kiểm tra
    $uploadOk = 1;


    if($_FILES["fileToUpload_CC"]["error"] == 0) {

      // Kiểm tra file có phải file ảnh không
      $check = getimagesize($_FILES["fileToUpload_CC"]["tmp_name"]);
      if($check !== false) {
        // echo "File is an image - " . $check["mime"] . "."
        $uploadOk = 1;
      } 
      else {
        $uploadOk = 0;
      }

      // Kiểm tra nếu file upload đã tồn tại
      if (file_exists($target_file)) {
        $uploadOk = 0;
      }

      // Kiểm tra file size
      if ($_FILES["fileToUpload_CC"]["size"] > 5000000) {
        $uploadOk = 0;
      }

      // Kiểm tra định dạng file
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
      }

      // Kiểm tra biến $uploadOk
      if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload_CC"]["tmp_name"], $target_file)) {
          // Đổi tên file (tên mới)
          $name = $_SESSION['username'];
          $newname = $target_dir . $name . "." . $imageFileType;
          if(file_exists($newname)){
            unlink($newname);
          }
          
          rename($target_file, $newname);
          // Cập nhật lại database
          require_once('models/data_access_helper.php');
          $db = new DataAccessHelper();
          $db->connect();
          $sql = "UPDATE chungchi SET ImageLink = '". $newname ."' WHERE Username = '". $_SESSION['username'] . "';";
          $db->executeNonQuery($sql);
          $db->close();
        }
      }
    }
  }
?>