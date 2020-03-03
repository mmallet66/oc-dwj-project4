<?php

abstract class Autoloader
{

  static $_Repertories = ["model", "controller"];

  static function autoload($classe)
  {
    foreach(self::$_Repertories as $repertory)
    {
      $path = $repertory . DIRECTORY_SEPARATOR . $classe . ".php";
      if(file_exists($path))
      {
        require $path;
      }
    }
  }

  static function register()
  {
    spl_autoload_register(array(__CLASS__, "autoload"));
  }
}