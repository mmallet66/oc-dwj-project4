<?php

require_once "Manager.php";
require_once "User.php";

/**
 * Class UserManager
 * 
 * Allows you create a user manager. Insert, recover, update, delete, a user in database
 */
class UserManager extends Manager
{
//PROPERTIES
  /**
   * @var object PDO Stores the connection with the database
   */
  private $_db;

// METHODS
  public function __construct()
  {
    $this->_db = $this->dbConnect();
  }

  /**
   * @param object $user
   * 
   * @return affectedLines Number of rows affected in the database or false if an error occured
   */
  public function adduser(object $user)
  {
    $req = $this->_db->prepare('INSERT INTO users(login, password, first-name, name, e-mail, role) VALUES (?, ?, ?, ?, ?, ?)');

    $affectedLines = $req->execute(array(
      $user->getLogin(),
      $user->getPassword(),
      $user->getFirstName(),
      $user->getName(),
      $user->getEMail(),
      $user->getRole()
    ));

    return $affectedLines;
  }

  /**
   * @param object $user
   * 
   * @return affectedLines Number of rows affected in the database or false if an error occured
   */
  public function getuser(object $user)
  {
    $req = $this->_db->prepare('SELECT id, login, password, first-name, name, e-mail, role FROM users WHERE id=?');

    $affectedLines = $req->execute(array(
      $user->getId()
    ));

    return $affectedLines;
  }
}