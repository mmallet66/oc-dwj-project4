<?php

abstract class Manager
{

  protected function dbConnect()
  {

    $db = new PDO("mysql:host=localhost;dbname=forteroche_blog;charset=utf8", "mathieu", "passe");

    return $db;
  }

}