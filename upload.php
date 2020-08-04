
// for uploading one file at a time.
// method is POST, name = uploadFile
// https://www.aurigma.com/upload-suite/developers/php/how-to-upload-files-in-php


<?php
  if ($_FILES["uploadFile"]["error"] > 0)
    echo "Return Code: " . $_FILES["uploadFile"]["error"] . "<br>";
  else               
  {                
    if (file_exists("http://vanguardtech.co.ke/mpesa/upload" . $_FILES["uploadFile"]["name"]))                
      echo $_FILES["uploadFile"]["name"] . " already exists. ";                
    else               
    {                
      echo $_FILES["uploadFile"]["name"] . " has been uploaded. <br>";
      move_uploaded_file($_FILES["uploadFile"]["tmp_name"],
      "upload/" . $_FILES["uploadFile"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["uploadFile"]["name"];
    }                
  }                
?>