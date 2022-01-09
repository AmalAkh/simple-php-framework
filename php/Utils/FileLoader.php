<?php
class FileLoader
{
  static function loadFile($field_name, $file_path)
  {
    if($_FILES[$field_name]['error'] == UPLOAD_ERR_OK)
    {
      $save_path = $file_path;
      move_uploaded_file($_FILES[$field_name]["tmp_name"], $save_path);
      echo $filename;
    }else
    {
      http_response_code(500);
    }
  }
  

}

?>
