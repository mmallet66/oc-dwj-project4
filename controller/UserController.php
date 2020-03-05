<?php

class UserController
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

    header("Location: index.php?action=login");
  }

  public function checkPassword(array $loginPass)
  {
    $login = $loginPass["username"];
    $passwd = $loginPass["password"];

    $data = $this->userManager->getUser($login);
    $this->user->hydrate($data);

    if(!password_verify($passwd, $this->user->getPassword())):
      header("Location: index.php?action=login&errorLogin=1");
      exit();
    endif;
  }

  public function connect(array $loginPass)
  {
    $this->checkPassword($loginPass);
    
    session_start();
    $_SESSION["userId"] = $this->user->getId();
    $_SESSION["role"] = $this->user->getRole();

    header("Location: index.php");
  }
}