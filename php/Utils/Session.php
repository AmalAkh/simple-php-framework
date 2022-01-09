<?php
class Session
{
   static function setValue($name, $value)
   {
     $_SESSION[$name] = $value;
   }
   static function getValue($name)
   {
     return $_SESSION[$name];
   }
   static function removeValue($name)
   {
     unset($_SESSION[$name]);
   }


}

?>
