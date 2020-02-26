<?php

require_once "model/User.php";
require_once "model/UserManager.php";

class ConnectionController
{

  public $user;
  public $userManager;
  
  public function __construct()
  {
    $this->user = new User;
    $this->userManager = new UserManager;
  }

  public function addNewUser(array $data)
  {
    $this->user->hydrate($data);

    $affectedLine = $this->userManager->addUser($this->user);
    
    if($affectedLine === false)
    {
      throw new Exception("Une erreur s'est produite, veuillez réessayer");
    }

    header("Location: index.php?page=login");
  }

  public function checkUser(array $loginPass)
  {
    $login = $loginPass["username"];
    $passwd = sha1($loginPass["password"]);

    $data = $this->userManager->getUser($login);
    $this->user->hydrate($data);

    if($this->user->getPassword() == $passwd)
    {
      return $this->user->getRole();
    }
    else
    {
      return false;
    }
  }
}