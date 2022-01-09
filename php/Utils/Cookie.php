<?php
class Cookie
{
   static function createCookie($name, $value, $time)
   {
     setcookie($name, $value, time()+$time);
   }
   static function removeCookie($name)
   {
     setcookie($name, "", time()-3600);
   }
   static function setCookie($name, $value)
   {
     $_COOKIE[$name] = $value;
   }
   static function getCookie($name)
   {
     return $_COOKIE[$name];
   }

}

?>
