<?php
class RestController
{


  public $actions;
  function setHandler($action, $func)
  {
    $this->actions[$action]=$func;
  }
  function execute($action, $db, $data)
  {
    $this->actions[$action]($db,$data);
  }
  function secureField($value)
  {
    return htmlentities($value);
  }

  function __construct()
  {

    $this->actions = array();
  }



}

?>
