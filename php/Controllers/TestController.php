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
    $this->setHandler("auth", function($db, $data)
    {
      $auth_service = new AuthService($db, "auth_cookie_key", "users");
      echo $auth_service->auth("login", "password");
    });
    $this->setHandler("checkAuth", function($db, $data)
    {
      $auth_service = new AuthService($db, "auth_cookie_key", "users");
      $auth_service->checkAuth();
    });
    $this->setHandler("logout", function($db, $data)
    {
      $auth_service = new AuthService($db, "auth_cookie_key", "users");
      $auth_service->logout();
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
