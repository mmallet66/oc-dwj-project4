<?php

class Router 
{
  public function traitment(){
    try
    {
      if(isset($_GET["status"]) && $_GET["status"] == "admin")
      {
        $userController = new UserController();
        if($userController->isAdmin()):
          $this->getAdminView();
          exit();
        else:
          throw new Exception("Accès refusé");
        endif;
      }
      if (isset($_GET["action"]))
      {
        switch($_GET["action"])
        {
          case "about":
            require "view/front-office/about.php";
          break;

          case "read-synopsis":
            $chapterController = new ChapterController();
            $chapterController->readSynopsis();
          break;

          case "read-chapter":
            if(isset($_GET["chapterId"]))
            {
              $chapterId = $_GET["chapterId"];
            }
            if(isset($_POST["chapterId"]))
            {
              $chapterId = $_POST["chapterId"];
            }
            $chapterController = new ChapterController();
            $chapterController->readChapter($chapterId);
          break;

          case "report-comment":
            $commentId = $this->getParameter($_GET, "commentId");
            $commentController = new CommentController();
            $commentController->reportComment($commentId);
          break;
          
          case "login":
            (isset($_GET["errorLogin"]) && $_GET["errorLogin"] == 1) ? $errorLogin=1 : $errorLogin=null;
            require "view/front-office/login.php";
          break;

          case "connect":
            $dataEntered = array(
              "username" => $this->getParameter($_POST, "username"),
              "password" => $this->getParameter($_POST, "password")
            );
            $userController = new UserController();
            $userController->connect($dataEntered);
          break;

          case "disconnect":
            session_start();
            session_unset();
            require "view/front-office/accueil.php";
          break;

          case "registration":
            require "view/front-office/registration.php";
          break;

          case "new-user":
            $userData = array(
              "login" => $this->getParameter($_POST, "login"),
              "mail" => $this->getParameter($_POST, "mail"),
              "password" => $this->getParameter($_POST, "password")
            );
            $userController = new UserController();
            $userController->addNewUser($userData);
          break;

          case "new-comment":
            $commentData = array(
              "authorId" => $this->getParameter($_GET, "authorId"),
              "content" => $this->getParameter($_POST, "content"),
              "chapterId" => $this->getParameter($_GET, "chapterId")
            );
            $commentController = new CommentController();
            $commentController->postNewComment($commentData);
          break;

          default:
            throw new Exception("Oups ! Cette page n'existe pas.");
          break;
        }
      }
      else
      {
        require "view/front-office/accueil.php";
      }
    }
    catch(Exception $e)
    {
      $errorMessage = $e->getMessage();
      require "view/front-office/error.php";
    }
  }

  private function getAdminView()
  {
    if (isset($_GET["action"]))
    {
      switch($_GET["action"]):
        case "administration":
        break;
        case "moderation":
        break;
        case "edition":
        break;
        default:
          throw new Exception("Oups ! Cette page n'existe pas.");
        break;
      endswitch;
    }else{
      require "view/back-office/accueil.php";
    }
  }

  private function getParameter($container, $key) {
    if (isset($container[$key])) {
        return $container[$key];
    }
    else
        throw new Exception("Paramètre '$key' absent");
  }
}