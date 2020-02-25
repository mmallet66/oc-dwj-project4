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
  public function addUser(object $user)
  {
    $req = $this->_db->prepare('INSERT INTO users(login, password, e_mail) VALUES (?, ?, ?)');

    $affectedLines = $req->execute(array(
      $user->getLogin(),
      sha1($user->getPassword()),
      $user->getMail()
    ));

    return $affectedLines;
  }

  /**
   * @param integer $userId
   * 
   * @return affectedLines Number of rows affected in the database or false if an error occured
   */
  public function getUser(string $userLogin)
  {
    $req = $this->_db->prepare('SELECT id, login, password, e_mail AS mail, role FROM users WHERE login=?');

    $affectedLine = $req->execute(array($userLogin));
    
    return $affectedLine;
  }
}