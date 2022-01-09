<?php
class DB
{
   public $connection;
   function __construct($host, $login, $password, $base)
   {
     $this->connection = mysqli_connect($host, $login, $password, $base);



   }

   function query($query)
   {
     return mysqli_query($this->connection, $query);
   }
   function __destruct()
   {
     mysqli_close($this->connection);
   }

}

?>
