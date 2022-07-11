<?php

class AuthService
{
 //comment;

  private $cookieKey;
  private $db;
  private $usersTable;

  function __construct($db, $cookieKey, $users_table)
  {
    $this->cookieKey = $cookieKey;
    $this->db = $db;
    $this->usersTable = $users_table;

  }
  function auth($login, $password)
  {
    $rows = $this->db->query("SELECT `Password`,`Id` FROM `$this->usersTable` WHERE `Login`='$login'");
    if(mysqli_num_rows($rows) != 0)
    {

      $row = mysqli_fetch_assoc($rows);
      if(password_verify($password, $row["Password"]))
      {
        $token = TokenService::createAuthToken($row["Id"]);
        Session::setValue("UserId",$row["Id"]);

        Cookie::createCookie($this->cookieKey, $token, 631152000);

        return 2;
      }else
      {
        return 1;
      }
    }else
    {
        return 0;

    }
  }
  function logout()
  {
    Cookie::removeCookie($this->cookieKey);

  }
  function checkAuth()
  {

    if(isset($_COOKIE[$this->cookieKey]))
    {
      try
      {
        $data = TokenService::checkAuthToken($_COOKIE[$this->cookieKey]);
        Session::setValue("UserId",$data->Id);



      }catch(Exception $exp)
      {


        Cookie::removeCookie($this->cookieKey);
        http_response_code(401);
        throw new Exception();



      }



    }else
    {
      http_response_code(401);
      throw new Exception();
    }
  }

}

?>
