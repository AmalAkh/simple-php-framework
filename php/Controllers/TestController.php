<?php
class TestController extends RestController
{
  function __construct()
  {
    parent::__construct();

    $this->setHandler("showSmth", function($db, $data)
    {
      echo "test";
    });
    $this->setHandler("loadFile", function($db, $data)
    {

      if(strpos($data["headers"]['content-type'],"multipart/form-data") !== false)
      {

        FileLoader::loadFile("Tester", "images/test");
      }
    });
  }


}
$controller = new TestController();
?>
