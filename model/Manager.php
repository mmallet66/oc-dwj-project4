<?php

/**
 * Class Manager
 * 
 * Provides PDO connection for all heir classes
 */
abstract class Manager
{

  /**
   * @return object PDO - database connection
   */
  protected function dbConnect()
  {

    $db = new PDO("mysql:host=localhost;dbname=forteroche_blog;charset=utf8", "mathieu", "passe");

    return $db;
  }

}